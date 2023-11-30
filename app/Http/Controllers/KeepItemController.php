<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\KeepItem;

class KeepItemController extends Controller
{
    private $keep_item;
    private $menu;

    public function __construct(Menu $menu, KeepItem $keep_item) {
        $this->keep_item = $keep_item;
        $this->menu = $menu;
    }

    public function indexCal() {
        $all_items = $this->keep_item->all();
        $result = null;

        return view('others.calculator')
            ->with('all_items', $all_items)
            ->with('result', $result);
    }

    public function calculate(Request $request) {
        $request->validate([
            'price' => 'required|numeric|min:1'
        ]);

        $all_items = $this->keep_item->all();
        $result = 1;
        $status = $request->formula;
        $initial = $request->price;
        $total = 0;
        $note = '';
        $input = 0;
        $tax = 0;
        $svc = 0;
        $pertax = '';
        $persvc = '';

        if($request->type == 'cal') {
            $pertax = $request->tax . "%";
            $persvc = $request->svc . "%";

            if($request->formula == 'add') {
                if($request->svc == 0 && $request->tax == 0) {
                    $total = ceil($initial / 100) * 100;
                    $input = $total;
                    $note = "No SVC and TAX";
                } elseif($request->svc == 0) {
                    $total = ceil(($initial * (1 + ($request->tax / 100))) / 100) * 100;
                    $tax = ($total / ($request->tax + 100)) * $request->tax;
                    $input = $total - $tax;
                    $note = "Add " . $pertax . " TAX without SVC";
                } elseif($request->tax == 0) {
                    $total = ceil(($initial * (1 + ($request->svc / 100))) / 100) * 100;
                    $svc = ($total / ($request->svc + 100)) * $request->svc;
                    $input = $total - $svc;
                    $note = "Add " . $persvc . " SVC without TAX";
                } else {
                    $total = ceil((($initial * (1 + ($request->tax / 100))) * (1 + ($request->svc / 100))) / 100) * 100;
                    $tax = ($total / ($request->tax + 100)) * $request->tax;
                    $svc = (($total - $tax) / ($request->svc + 100)) * $request->svc;
                    $input = $total - $svc - $tax;
                    $note = "Add " . $persvc . " SVC and " . $pertax . " TAX";
                }
            } else {
                if($request->svc == 0 && $request->tax == 0) {
                    $total = $initial;
                    $input = $initial;
                    $note = "No SVC and TAX";
                } elseif($request->svc == 0) {
                    $tax = ($initial / ($request->tax + 100)) * $request->tax;
                    $total = $initial - $tax;
                    $input = $total;
                    $note = "Remove " . $pertax . " TAX without SVC";
                } elseif($request->tax == 0) {
                    $svc = ($initial / ($request->svc + 100)) * $request->svc;
                    $total = $initial - $svc;
                    $input = $total;
                    $note = "Remove " . $persvc . " SVC without TAX";
                } else {
                    $tax = ($initial / ($request->tax + 100)) * $request->tax;
                    $svc = (($initial - $tax) / ($request->svc + 100)) * $request->svc;
                    $total = $initial - $svc - $tax;
                    $input = $total;
                    $note = "Remove " . $persvc . " SVC and " . $pertax . " TAX";
                }
            }
        } else {
            $pertax = "10%";
            $persvc = $request->way . "%";
            if($request->way == 18) {
                $input = ($initial / 1.16) / 1.1;
                $total = ceil(($input * 1.1 * 1.18) / 100) * 100;
                $tax = ($total / 110) * 10;
                $svc = (($total - $tax) / 118) * 18;
                $input = $total - $svc - $tax;
                $note = "Change SVC from 16% to 18%";
            } else {
                $input = ($initial / 1.18) / 1.1;
                $total = ceil(($input * 1.1 * 1.16) / 100) * 100;
                $tax = ($total / 110) * 10;
                $svc = (($total - $tax) / 116) * 16;
                $input = $total - $svc - $tax;
                $note = "Change SVC from 18% to 16%";
            }
        }

        return view('others.calculator')
            ->with('all_items', $all_items)
            ->with('result', $result)
            ->with('status', $status)
            ->with('initial', $initial)
            ->with('total', $total)
            ->with('note', $note)
            ->with('input', $input)
            ->with('tax', $tax)
            ->with('svc', $svc)
            ->with('pertax', $pertax)
            ->with('persvc', $persvc);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:1|max:100'
        ]);

        $this->keep_item->name = $request->name;
        $this->keep_item->price = $request->price;
        $this->keep_item->save();

        return redirect()->route('other.calculator');
    }

    public function destroy($id) {
        $this->keep_item->destroy($id);

        return redirect()->route('other.calculator');
    }

    public function goOffline() {
        $result = null;
        $final = null;

        return view('others.offline')
            ->with('result', $result)
            ->with('final', $final);
    }

    public function field(Request $request) {
        $request->validate([
            'number' => 'required|numeric|min:1',
            'exclude' => 'nullable'
        ]);
        
        $all_menus = $this->menu->whereNotNull('price')->get();
        $result = $request->number;
        $final = null;
        $exclude = 0;

        if($request->exclude) {
            if(count($request->exclude) == 2) {
                $exclude = 1;
            } elseif($request->exclude == "tax") {
                $exclude = 2;
            } elseif($request->exclude == "svc") {
                $exclude = 3;
            }
        }

        session(['exclude' => $exclude]);

        return view('others.offline')
            ->with('all_menus', $all_menus)
            ->with('exclude', $exclude)
            ->with('result', $result)
            ->with('final', $final);
    }

    public function calculateOrder(Request $request) {

        $exclude = session('exclude');
        $result = null;
        $final = count($request->menu);
        $menu = [];
        $price = [];
        $amount = [];
        $total = 0;
        $svc = 0;
        $tax = 0;
        $subtotal = 0;
        $note = "";

        for($i = 0; $i < $final; $i++) {
            if($request->menu[$i] == "none") {
                $menu[] = $request->name[$i];
                $price[] = $request->price[$i];
                $amount[] = $request->amount[$i];
                $total += $request->price[$i] * $request->amount[$i];
            } else {
                $menu[] = $this->menu->where('id', $request->menu[$i])->value('name');
                $price[] = $this->menu->where('id', $request->menu[$i])->value('price');
                $amount[] = $request->amount[$i];
                $total += $this->menu->where('id', $request->menu[$i])->value('price') * $request->amount[$i];
            }
        }

        if($exclude == 0) {
            // nomal
            $tax = ($total / 110) * 10;
            $svc = (($total - $tax) / 118) * 18;
            $subtotal = $total - $svc - $tax;
            $note = "TAX 10% and SVC 18%";
        } elseif($exclude == 1) {
            // no both
            $tax = ($total / 110) * 10;
            $svc = (($total - $tax) / 118) * 18;
            $subtotal = $total - $svc - $tax;
            $total = $subtotal;
            $note = "NO TAX and SVC";
        } elseif($exclude == 2) {
            // no tax
            $svc = (($total - (($total / 110) * 10)) / 118) * 18;
            $subtotal = $total - $svc - (($total / 110) * 10);
            $total = $svc + $subtotal;
            $note = "SVC 18% (no Tax)";
        } else {
            // no svc
            $subtotal = $total - ((($total - (($total / 110) * 10)) / 118) * 18) - (($total / 110) * 10);
            $total = $subtotal * 1.1;
            $tax = $subtotal * 0.1;
            $note = "TAX 10% (no SVC)";
        }

        return view('others.offline')
            ->with('result', $result)
            ->with('final', $final)
            ->with('menu', $menu)
            ->with('amount', $amount)
            ->with('price', $price)
            ->with('total', $total)
            ->with('svc', $svc)
            ->with('tax', $tax)
            ->with('subtotal', $subtotal)
            ->with('note', $note);
    }
}

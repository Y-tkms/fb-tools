<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeepItem;

class KeepItemController extends Controller
{
    private $keep_item;

    public function __construct(KeepItem $keep_item) {
        $this->keep_item = $keep_item;
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
}

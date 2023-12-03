<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ArrItem;

class ArrItemController extends Controller
{
    private $arr_item;

    public function __construct(ArrItem $arr_item) {
        $this->arr_item = $arr_item;
    }

    public function index() {
        $items = $this->arr_item->where('status', 1)->get();

        if(Auth::user()->role == "em" || Auth::user()->role == "u") {
            return redirect()->route('index');
        }

        return view('reservations.setting.arrengements.index')->with('items', $items);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:1|max:100'
        ]);

        $this->arr_item->name = $request->name;
        $this->arr_item->save();

        return redirect()->back();
    }

    public function edit($id) {
        $item = $this->arr_item->findOrFail($id);

        return view('reservations.setting.arrengements.edit')->with('item', $item);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|min:1|max:100'
        ]);

        $item = $this->arr_item->findOrFail($id);
        $item->name = $request->name;
        $item->save();

        return redirect()->route('rsv.set.arr.index');
    }

    public function delete($id) {
        $item = $this->arr_item->findOrFail($id);

        return view('reservations.setting.arrengements.delete')->with('item', $item);
    }

    public function deactivate($id) {
        $item = $this->arr_item->findOrFail($id);
        $item->status = 0;
        $item->save();

        return redirect()->route('rsv.set.arr.index');
    }
}

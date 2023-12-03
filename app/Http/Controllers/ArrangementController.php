<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Arrangement;
use App\Models\ArrItem;

class ArrangementController extends Controller
{
    private $arrangement;
    private $arr_item;

    public function __construct(Arrangement $arrangement, ArrItem $arr_item) {
        $this->arrangement = $arrangement;
        $this->arr_item = $arr_item;
    }

    public function add($id) {
        $this->arrangement->reservation_id = $id;
        $this->arrangement->save();

        return redirect()->back();
    }

    public function edit($id) {
        $arrangement = $this->arrangement->findOrFail($id);
        $items = $this->arr_item->where('status', 1)->get();

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.arrangement.index');
        }

        return view('reservations\arrangements\items\edit')
            ->with('arrangement', $arrangement)
            ->with('items', $items);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'main' => 'nullable|min:0|max:50',
            'other' => 'nullable|max:100',
            'info' => 'nullable|min:0|max:10000'
        ]);

        $item = $this->arrangement->findOrFail($id);
        $item->other_item = $request->other;
        $item->information = $request->info;
        $item->arr_item_id = $request->main;
        $item->save();

        return redirect()->route('rsv.arrangement.show', $item->reservation_id);
    }

    public function destroy($id) {
        $item = $this->arrangement->findOrFail($id);
        $item->delete();

        return redirect()->route('rsv.arrangement.show', $item->reservation_id);
    }
}

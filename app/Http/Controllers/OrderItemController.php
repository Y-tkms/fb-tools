<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RsvSection;
use App\Models\OrderItem;


class OrderItemController extends Controller
{
    private $order_item;
    private $rsv_section;

    public function __construct(OrderItem $order_item, RsvSection $rsv_section) {
        $this->order_item = $order_item;
        $this->rsv_section = $rsv_section;
    }

    public function index() {
        $items = $this->order_item->all();
        $sections = $this->rsv_section->all();

        if(Auth::user()->role != "a") {
            return redirect()->route('index');
        }

        return view('reservations\setting\order-item\index')
            ->with('sections', $sections)
            ->with('items', $items);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'section' => 'required'
        ]);

        $this->order_item->name = $request->name;
        $this->order_item->rsv_section_id = $request->section;
        $this->order_item->save();

        return redirect()->back();
    }
}

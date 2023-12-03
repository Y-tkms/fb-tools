<?php

namespace App\Http\Controllers;

use App\Models\Arrangement;
use App\Models\Reservation;
use App\Models\RsvSection;
use App\Models\Kid;
use App\Models\Date;
use App\Models\Time;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ArrItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    private $reservation;
    private $rsv_section;
    private $kid;
    private $date;
    private $order;
    private $order_item;
    private $time;
    private $arr_item;
    private $arrangement;

    public function __construct(Reservation $reservation, RsvSection $rsv_section, Kid $kid, Date $date, Order $order, Time $time, OrderItem $order_item, ArrItem $arr_item, Arrangement $arrangement) {
        $this->reservation = $reservation;
        $this->rsv_section = $rsv_section;
        $this->kid = $kid;
        $this->date = $date;
        $this->order = $order;
        $this->time = $time;
        $this->order_item = $order_item;
        $this->arr_item = $arr_item;
        $this->arrangement = $arrangement;
    }

    //arrengement
    public function indexArr() {
        $section = $this->rsv_section->where('name', 'Arrangement')->first();
        $today = Carbon::now()->toDateString();
        $reservations = $this->reservation->where('other_date', $today)->where('rsv_section_id', $section->id)->where('status', 1)->orderBy('other_time')->get();

        return view('reservations.arrangements.index')
            ->with('today', $today)
            ->with('reservations', $reservations);
    }

    public function createArr() {
        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.arrangement.index');
        }

        return view('reservations.arrangements.create');
    }
    
    public function storeArr(Request $request) {
        $section = $this->rsv_section->where('name', 'Arrangement')->first();

        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'phone' => 'nullable',
            'email' => 'nullable',
            'date' => 'required',
            'time' => 'required|min:1|max:100',
            'item' => 'required|numeric|min:1|max:10',
            'total' => 'nullable|numeric|min:1|max:15',
            'preference' => 'nullable|max:50000'
        ]);

        $this->reservation->guest_name = $request->name;
        $this->reservation->room_number = $request->room_num;
        $this->reservation->phone_number = $request->phone;
        $this->reservation->email = $request->email;
        $this->reservation->other_date = $request->date;
        $this->reservation->other_time = $request->time;
        $this->reservation->people_number = $request->total;
        $this->reservation->preference = $request->preference;
        $this->reservation->rsv_section_id = $section->id;
        $this->reservation->save();
        
        for($i = 1; $i <= $request->item; $i++) {
            $item = new Arrangement();
            $item->reservation_id = $this->reservation->id;
            $item->save();
        }

        return redirect()->route('rsv.arrangement.show', $this->reservation->id);
    }

    public function editArr($id) {
        $reservation = $this->reservation->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.arrangement.index');
        }

        return view('reservations.arrangements.edit')->with('reservation', $reservation);
    }

    public function updateArr(Request $request, $id) {
        $section = $this->rsv_section->where('name', 'Arrangement')->first();

        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'phone' => 'nullable',
            'email' => 'nullable',
            'date' => 'required',
            'time' => 'required|min:1|max:100',
            'total' => 'nullable|numeric|min:1|max:15',
            'preference' => 'nullable|max:50000'
        ]);

        $reservation = $this->reservation->findOrFail($id);
        $reservation->guest_name = $request->name;
        $reservation->room_number = $request->room_num;
        $reservation->phone_number = $request->phone;
        $reservation->email = $request->email;
        $reservation->other_date = $request->date;
        $reservation->other_time = $request->time;
        $reservation->people_number = $request->total;
        $reservation->preference = $request->preference;
        $reservation->save();

        return redirect()->route('rsv.arrangement.index');
    }

    public function deleteArr($id) {
        $reservation = $this->reservation->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.arrangement.index');
        }

        return view('reservations.arrangements.delete')->with('reservation', $reservation);
    }

    public function deactivateArr($id) {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->status = 0;
        $reservation->save();

        return redirect()->route('rsv.arrangement.index');
    }

    public function showArr($id) {
        $reservation = $this->reservation->findOrFail($id);
        $items = $this->arrangement->where('reservation_id', $reservation->id)->get();
        $id = $reservation->id;

        return view('reservations.arrangements.items.show')
            ->with('items', $items)
            ->with('id', $id);
    }

    public function historyArr() {
        $section = $this->rsv_section->where('name', 'Arrangement')->first();
        $reservations = $this->reservation->where('other_date', '<', Carbon::today())->where('rsv_section_id', $section->id)->where('status', 1)->orderBy('other_date', 'desc')->get();

        return view('reservations.arrangements.history')->with('reservations', $reservations);
    }

    //regular
    public function indexRegular() {
        $section = $this->rsv_section->where('name', 'Regular')->first();
        $today = Carbon::now()->toDateString();
        $reservations = $this->reservation->where('other_date', $today)->where('rsv_section_id', $section->id)->where('status', 1)->orderBy('other_time')->get();
        $complete = $this->reservation->where('other_date', $today)->where('rsv_section_id', $section->id)->where('status', 2)->orderBy('other_time')->get();

        return view('reservations.regular.index')
            ->with('today', $today)
            ->with('reservations', $reservations)
            ->with('complete', $complete);
    }

    public function createRegular() {
        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.regular.index');
        }

        return view('reservations.regular.create');
    }

    public function storeRegular(Request $request) {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'nullable',
            'total' => 'nullable|numeric|min:1|max:50',
            'child' => 'nullable|numeric|min:0|max:' . $request->total
        ]);

        $section = $this->rsv_section->where('name', 'Regular')->first();
        $this->reservation->guest_name = $request->name;
        $this->reservation->room_number = $request->room_num;
        $this->reservation->other_date = $request->date;
        $this->reservation->other_time = $request->time;
        $this->reservation->people_number = $request->total;
        $this->reservation->rsv_section_id = $section->id;
        $this->reservation->save();

        if($request->child > 0) {
            for($i = 1; $i <= $request->child; $i++) {
                $kid = new Kid();
                $kid->reservation_id = $this->reservation->id;
                $kid->save();
            }
        }

        return redirect()->route('rsv.regular.index');
    }

    public function completeRegular($id) {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->status = 2;
        $reservation->save();

        return redirect()->back();
    }

    public function returnRegular($id) {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->status = 1;
        $reservation->save();

        return redirect()->back();
    }

    public function editRegular($id, $type) {
        $reservation = $this->reservation->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.regular.index');
        }

        return view('reservations.regular.edit')
            ->with('reservation', $reservation)
            ->with('type', $type);
    }

    public function updateRegular(Request $request, $id, $type) {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'nullable',
            'total' => 'nullable|numeric|min:1|max:50',
        ]);

        $reservation = $this->reservation->findOrFail($id);
        $reservation->guest_name = $request->name;
        $reservation->room_number = $request->room_num;
        $reservation->other_date = $request->date;
        $reservation->other_time = $request->time;
        $reservation->people_number = $request->total;
        $reservation->save();

        if($type == "today") {
            return redirect()->route('rsv.regular.index');
        } else {
            return redirect()->route('rsv.regular.other');
        }
    }

    public function deleteRegular($id, $type) {
        $reservation = $this->reservation->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.regular.index');
        }

        return view('reservations.regular.delete')
            ->with('reservation', $reservation)
            ->with('type', $type);
    }

    public function deactivateRegular($id, $type) {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->status = 0;
        $reservation->save();

        if($type == "today") {
            return redirect()->route('rsv.regular.index');
        } else {
            return redirect()->route('rsv.regular.other');
        }
    }

    public function historyRegular() {
        $section = $this->rsv_section->where('name', 'Regular')->first();
        $reservations = $this->reservation->where('other_date', '<', Carbon::today())->where('rsv_section_id', $section->id)->where('status', 1)->orderBy('other_date', 'desc')->get();

        return view('reservations.regular.history')->with('reservations', $reservations);
    }

    public function otherRegular() {
        $section = $this->rsv_section->where('name', 'Regular')->first();
        $reservations = $this->reservation->where('rsv_section_id', $section->id)->whereDate('other_date', '>', Carbon::today())->where('status', 1)->orderBy('other_time')->get();
        $type = 'other';

        return view('reservations.regular.other')
            ->with('reservations', $reservations)
            ->with('type', $type);
    }

    // course
    public function indexCourse() {
        $section = $this->rsv_section->where('name', 'Course')->first();
        $today = Carbon::now('Asia/Tokyo');
        $reservations = $this->reservation->where('rsv_section_id', $section->id)->whereDate('other_date', '>=', Carbon::today('Asia/Tokyo'))->where('status', 1)->orderBy('other_time')->get();

        return view('reservations.course.index')
            ->with('today', $today)
            ->with('reservations', $reservations);
    }

    public function createCourse() {
        $menus = $this->order_item->where('name', 'Japanese Course')->orWhere('name', 'Western Course')->get();

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.course.index');
        }

        return view('reservations.course.create')->with('menus', $menus);
    }

    public function storeCourse(Request $request) {
        $section = $this->rsv_section->where('name', 'Course')->first();

        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'date' => 'required',
            'time' => 'nullable',
            'menu' => 'nullable',
            'dish' => 'required|numeric|min:0|max:' . $section->max,
            'total' => 'nullable|numeric|min:1|max:15',
            'preference' => 'nullable|max:50000'
        ]);

        $this->reservation->guest_name = $request->name;
        $this->reservation->room_number = $request->room_num;
        $this->reservation->other_date = $request->date;
        $this->reservation->other_time = $request->time;
        $this->reservation->people_number = $request->total;
        $this->reservation->preference = $request->preference;
        $this->reservation->rsv_section_id = $section->id;
        $this->reservation->save();

        $this->order->dish = $request->dish;
        $this->order->reservation_id = $this->reservation->id;
        $this->order->order_item_id = $request->menu;
        $this->order->save();

        return redirect()->route('rsv.course.index');
    }

    public function editCourse($id) {
        $menus = $this->order_item->where('name', 'Japanese Course')->orWhere('name', 'Western Course')->get();
        $reservation = $this->reservation->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.regular.index');
        }

        return view('reservations.course.edit')
            ->with('menus', $menus)
            ->with('reservation', $reservation);
    }

    public function updateCourse(Request $request, $id) {
        $section = $this->rsv_section->where('name', 'Course')->first();
        $reservation = $this->reservation->findOrFail($id);
        $order = $this->order->findOrFail($reservation->order->id);

        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'date' => 'required',
            'time' => 'nullable',
            'menu' => 'nullable',
            'dish' => 'required|numeric|min:0|max:' . $section->max,
            'total' => 'nullable|numeric|min:1|max:15',
            'preference' => 'nullable|max:50000'
        ]);

        $reservation->guest_name = $request->name;
        $reservation->room_number = $request->room_num;
        $reservation->other_date = $request->date;
        $reservation->other_time = $request->time;
        $reservation->people_number = $request->total;
        $reservation->preference = $request->preference;
        $reservation->save();

        $order->dish = $request->dish;
        $order->order_item_id = $request->menu;
        $order->save();

        return redirect()->route('rsv.course.index');
    }

    public function deleteCourse($id) {
        $reservation = $this->reservation->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.christmas.index');
        }

        return view('reservations.course.delete')
            ->with('reservation', $reservation);
    }

    public function deactivateCourse($id) {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->status = 0;
        $reservation->save();

        return redirect()->route('rsv.course.index');
    }

    public function historyCourse() {
        $section = $this->rsv_section->where('name', 'Course')->first();
        $reservations = $this->reservation->where('other_date', '<', Carbon::today())->where('rsv_section_id', $section->id)->where('status', 1)->orderBy('other_date', 'desc')->get();

        return view('reservations.course.history')->with('reservations', $reservations);
    }
    
    // christmas
    public function indexXmas() {
        $section = $this->rsv_section->where('name', 'Christmas')->first();
        $year = now()->year;
        $date = $this->date->whereYear('date', $year)->orderBy('date')->get();
        $reservations = $this->reservation->where('rsv_section_id', $section->id)->where('status', 1)->orderBy('other_time')->get();
        
        return view('reservations.christmas.index')
            ->with('date', $date)
            ->with('reservations', $reservations);
    }

    public function createXmas() {
        $year = now()->year;
        $date = $this->date->whereYear('date', $year)->orderBy('date')->get();

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.christmas.index');
        }

        return view('reservations.christmas.create')->with('date', $date);
    }

    public function storeXmas(Request $request) {
        $section = $this->rsv_section->where('name', 'Christmas')->first();
        $menu = $this->order_item->where('name', 'Christmas Course')->first();

        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'phone' => 'nullable',
            'email' => 'nullable',
            'date' => 'required',
            'time' => 'required',
            'dish' => 'required|numeric|min:0|max:' . $section->max,
            'total' => 'nullable|numeric|min:1|max:15',
            'child' => 'nullable|numeric|min:0|max:' . $request->total,
            'preference' => 'nullable|max:50000'
        ]);

        $this->reservation->guest_name = $request->name;
        $this->reservation->room_number = $request->room_num;
        $this->reservation->phone_number = $request->phone;
        $this->reservation->email = $request->email;
        $this->reservation->date_id = $request->date;
        $this->reservation->other_time = $request->time;
        $this->reservation->people_number = $request->total;
        $this->reservation->preference = $request->preference;
        $this->reservation->rsv_section_id = $section->id;
        $this->reservation->save();

        $this->order->dish = $request->dish;
        $this->order->reservation_id = $this->reservation->id;
        $this->order->order_item_id = $menu->id;
        $this->order->save();

        if($request->child > 0) {
            for($i = 1; $i <= $request->child; $i++) {
                $kid = new Kid();
                $kid->reservation_id = $this->reservation->id;
                $kid->save();
            }
        }

        return redirect()->route('rsv.xmas.index');
    }

    public function editXmas($id) {
        $reservation = $this->reservation->findOrFail($id);
        $year = now()->year;
        $date = $this->date->whereYear('date', $year)->orderBy('date')->get();

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.christmas.index');
        }

        return view('reservations.christmas.edit')
            ->with('date', $date)
            ->with('reservation', $reservation);
    }

    public function updateXmas(Request $request, $id) {
        $section = $this->rsv_section->where('name', 'Christmas')->first();
        $reservation = $this->reservation->findOrFail($id);
        $order = $this->order->findOrFail($reservation->order->id);

        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'phone' => 'nullable',
            'email' => 'nullable',
            'date' => 'required',
            'time' => 'required',
            'dish' => 'required|numeric|min:0|max:' . $section->max,
            'total' => 'nullable|numeric|min:1|max:15',
            'preference' => 'nullable|max:50000'
        ]);

        $reservation->guest_name = $request->name;
        $reservation->room_number = $request->room_num;
        $reservation->phone_number = $request->phone;
        $reservation->email = $request->email;
        $reservation->date_id = $request->date;
        $reservation->other_time = $request->time;
        $reservation->people_number = $request->total;
        $reservation->preference = $request->preference;
        $reservation->save();

        $order->dish = $request->dish;
        $order->save();

        return redirect()->route('rsv.xmas.index');
    }

    public function deleteXmas($id) {
        $reservation = $this->reservation->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.christmas.index');
        }

        return view('reservations.christmas.delete')
            ->with('reservation', $reservation);
    }

    public function deactivateXmas($id) {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->status = 0;
        $reservation->save();

        return redirect()->route('rsv.xmas.index');
    }

    public function historyXmas() {
        $section = $this->rsv_section->where('name', 'Christmas')->first();
        $reservations = $this->reservation->where('rsv_section_id', $section->id)->where('status', 1)->latest()->get();

        return view('reservations.christmas.history')
            ->with('reservations', $reservations);
    }

    public function showKidsXmas($id) {
        $reservation = $this->reservation->findOrFail($id);
        $kids = $this->kid->where('reservation_id', $reservation->id)->get();
        $id = $reservation->id;

        return view('reservations.christmas.kids.show')
            ->with('kids', $kids)
            ->with('id', $id);
    }

    // new year
    public function indexNewYear() {
        $dec_section = $this->rsv_section->where('name', '12/31')->first();
        $jan_section = $this->rsv_section->where('name', '1/1')->first();
        $dec_menu = $this->order_item->where('name', 'Soba')->first();
        $jan_menu = $this->order_item->where('name', 'Osechi')->first();
        $dec_order = $this->order->where('order_item_id', $dec_menu->id)->where('status', 1)->get();
        $jan_order = $this->order->where('order_item_id', $jan_menu->id)->where('status', 1)->get();
        $dec_total = $dec_order->sum('dish');
        $jan_total = $jan_order->sum('dish');
        $dec_max = $dec_section->max;
        $jan_max = $jan_section->max;
        

        return view('reservations.newyear.index')
            ->with('dec_total', $dec_total)
            ->with('jan_total', $jan_total)
            ->with('dec_max', $dec_max)
            ->with('jan_max', $jan_max);
    }

    public function showNewYear($type) {
        $dec = $this->rsv_section->where('name', '12/31')->first();
        $jan = $this->rsv_section->where('name', '1/1')->first();
        $dec_menu = $this->order_item->where('name', 'Soba')->first();
        $jan_menu = $this->order_item->where('name', 'Osechi')->first();
        $dec_order = $this->order->where('order_item_id', $dec_menu->id)->where('status', 1)->get();
        $jan_order = $this->order->where('order_item_id', $jan_menu->id)->where('status', 1)->get();
        $dec_total = $dec_order->sum('dish');
        $jan_total = $jan_order->sum('dish');
        $dec_max = $dec->max;
        $jan_max = $jan->max;

        if($type == 'dec') {
            $time = $this->time->where('rsv_section_id', $dec->id)->orderBy('time')->get();
        } else {
            $time = $this->time->where('rsv_section_id', $jan->id)->orderBy('time')->get();
        }

        $reservations = $this->reservation->where(function ($query) use ($dec, $jan) {
            $query->where('rsv_section_id', $dec->id)
                  ->orWhere('rsv_section_id', $jan->id);
        })
        ->where('status', 1)
        ->latest()
        ->get();

        return view('reservations.newyear.show', ['type' => $type])
            ->with('dec_total', $dec_total)
            ->with('jan_total', $jan_total)
            ->with('dec_max', $dec_max)
            ->with('jan_max', $jan_max)
            ->with('time', $time)
            ->with('reservations', $reservations)
            ->with('type', $type);
    }

    public function createNewYear($type) {
        $dec = $this->rsv_section->where('name', '12/31')->first();
        $jan = $this->rsv_section->where('name', '1/1')->first();

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.christmas.index');
        }

        if($type == 'dec') {
            $time = $this->time->where('rsv_section_id', $dec->id)->orderBy('time')->get();
        } else {
            $time = $this->time->where('rsv_section_id', $jan->id)->orderBy('time')->get();
        }

        return view('reservations.newyear.create', ['type' => $type])->with('time', $time);
    }

    public function storeNewYear(Request $request, $type) {
        $dec = $this->rsv_section->where('name', '12/31')->first();
        $dec_menu = $this->order_item->where('name', 'Soba')->first();
        $jan = $this->rsv_section->where('name', '1/1')->first();
        $jan_menu = $this->order_item->where('name', 'Osechi')->first();

        if($type == 'dec') {
            $section = $this->rsv_section->where('id', $dec->id)->first();
        } else {
            $section = $this->rsv_section->where('id', $jan->id)->first();
        }

        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'phone' => 'nullable',
            'email' => 'nullable',
            'time' => 'required',
            'dish' => 'required|numeric|min:0|max:' . $section->max,
            'total' => 'nullable|numeric|min:1|max:15',
            'child' => 'nullable|numeric|min:0|max:' . $request->total,
            'preference' => 'nullable|max:50000'
        ]);

        $this->reservation->guest_name = $request->name;
        $this->reservation->room_number = $request->room_num;
        $this->reservation->phone_number = $request->phone;
        $this->reservation->email = $request->email;
        $this->reservation->time_id = $request->time;
        $this->reservation->people_number = $request->total;
        $this->reservation->preference = $request->preference;
        $this->reservation->rsv_section_id = $section->id;
        $this->reservation->save();

        $this->order->dish = $request->dish;
        $this->order->reservation_id = $this->reservation->id;

        if($type == 'dec') {
            $this->order->order_item_id = $dec_menu->id;
        } else {
            $this->order->order_item_id = $jan_menu->id;
        }
        
        $this->order->save();

        if($request->child > 0) {
            for($i = 1; $i <= $request->child; $i++) {
                $kid = new Kid();
                $kid->reservation_id = $this->reservation->id;
                $kid->save();
            }
        }

        return redirect()->route('rsv.newyear.show', ['type' => $type])->with('type', $type);
    }

    public function editNewYear($id, $type) {
        $reservation = $this->reservation->findOrFail($id);
        
        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.christmas.index');
        }

        if($type == 'dec') {
            $time = $this->time->where('rsv_section_id', 6)->orderBy('time')->get();
        } else {
            $time = $this->time->where('rsv_section_id', 5)->orderBy('time')->get();
        }

        return view('reservations.newyear.edit', ['type' => $type])
            ->with('reservation', $reservation)
            ->with('type', $type)
            ->with('time', $time);
    }

    public function updateNewYear(Request $request, $id, $type) {
        $dec = $this->rsv_section->where('name', '12/31')->first();
        $jan = $this->rsv_section->where('name', '1/1')->first();

        if($type == 'dec') {
            $section = $this->rsv_section->where('id', $dec->id)->first();
        } else {
            $section = $this->rsv_section->where('id', $jan->id)->first();
        }

        $reservation = $this->reservation->findOrFail($id);
        $order = $this->order->findOrFail($reservation->order->id);

        $request->validate([
            'name' => 'required|min:1|max:50',
            'room_num' => 'nullable|numeric|min:1000|max:9999',
            'phone' => 'nullable',
            'email' => 'nullable',
            'time' => 'required',
            'dish' => 'required|numeric|min:0|max:' . $section->max,
            'total' => 'nullable|numeric|min:1|max:15',
            'preference' => 'nullable|max:50000'
        ]);

        $reservation->guest_name = $request->name;
        $reservation->room_number = $request->room_num;
        $reservation->phone_number = $request->phone;
        $reservation->email = $request->email;
        $reservation->time_id = $request->time;
        $reservation->people_number = $request->total;
        $reservation->preference = $request->preference;
        $reservation->save();

        $order->dish = $request->dish;
        $order->save();

        return redirect()->route('rsv.newyear.show', ['type' => $type])->with('type', $type);
    }

    public function deleteNewYear($id, $type) {
        $reservation = $this->reservation->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.newyear.show', ['type' => $type]);
        }

        return view('reservations.newyear.delete')
            ->with('reservation', $reservation)
            ->with('type', $type);
    }

    public function deactivateNewYear($id, $type) {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->order->update(['status' => 0]);
        $reservation->status = 0;
        $reservation->save();


        return redirect()->route('rsv.newyear.show', ['type' => $type])->with('type', $type);
    }

    public function showKidsNewYear($id, $type) {
        $reservation = $this->reservation->findOrFail($id);
        $kids = $this->kid->where('reservation_id', $reservation->id)->get();
        $id = $reservation->id;

        return view('reservations.newyear.kids.show')
            ->with('kids', $kids)
            ->with('id', $id)
            ->with('type', $type);
    }

    public function historyNewYear($type) {
        $dec = $this->rsv_section->where('name', '12/31')->first();
        $jan = $this->rsv_section->where('name', '1/1')->first();

        if($type == 'dec') {
            $reservations = $this->reservation->where('rsv_section_id', $dec->id)->where('status', 2)->get();
        } else {
            $reservations = $this->reservation->where('rsv_section_id', $jan->id)->where('status', 2)->get();
        }

        return view('reservations.newyear.history')
            ->with('reservations', $reservations)
            ->with('type', $type);
    }

    public function allDeleteNewYear($type) {
        return view('reservations.newyear.reset')->with('type', $type);
    }

    public function resetNewYear($type) {
        $dec = $this->rsv_section->where('name', '12/31')->first();
        $jan = $this->rsv_section->where('name', '1/1')->first();

        if($type == 'dec') {
            $reservations = $this->reservation->where('rsv_section_id', $dec->id)->where('status', 1)->get();
        } else {
            $reservations = $this->reservation->where('rsv_section_id', $jan->id)->where('status', 1)->get();
        }

        foreach ($reservations as $reservation) {
            $reservation->order->update(['status' => 2]);
            $reservation->update(['status' => 2]);
        }

        return redirect()->route('rsv.newyear.show', ['type' => $type])->with('type', $type);
    }
}

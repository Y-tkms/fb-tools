<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Time;
use App\Models\RsvSection;

class TimeController extends Controller
{
    private $time;
    private $rsv_section;

    public function __construct(Time $time, RsvSection $rsv_section) {
        $this->time = $time;
        $this->rsv_section = $rsv_section;
    }

    public function index() {
        $sections = $this->rsv_section->where('name', '1/1')->orWhere('name', '12/31')->get();
        $dec = $this->time->where('section_id', 6)->orderBy('time')->get();
        $jan = $this->time->where('section_id', 5)->orderBy('time')->get();

        if(Auth::user()->role != "a") {
            return redirect()->route('index');
        }

        return view('reservations.setting.time.index')
            ->with('sections', $sections)
            ->with('dec', $dec)
            ->with('jan', $jan);
    }

    public function store(Request $request) {
        $request->validate([
            'time' => 'required',
            'section' => 'required'
        ]);

        $this->time->time = $request->time;
        $this->time->rsv_section_id = $request->section;
        $this->time->save();

        return redirect()->back();
    }
}

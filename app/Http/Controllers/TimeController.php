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
        $dec_section = $this->rsv_section->where('name', '12/31')->first();
        $jan_section = $this->rsv_section->where('name', '1/1')->first();
        $sections = $this->rsv_section->where('name', '1/1')->orWhere('name', '12/31')->get();
        $dec = $this->time->where('rsv_section_id', $dec_section->id)->orderBy('time')->get();
        $jan = $this->time->where('rsv_section_id', $jan_section->id)->orderBy('time')->get();

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

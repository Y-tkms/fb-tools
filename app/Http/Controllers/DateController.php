<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Date;
use Illuminate\Support\Carbon;

class DateController extends Controller
{
    private $date;

    public function __construct(Date $date) {
        $this->date = $date;
    }

    public function index() {
        $year = Carbon::now()->year;
        $all_date = $this->date->whereYear('date', $year)->orderBy('date', 'asc')->get();

        if(Auth::user()->role == "em" || Auth::user()->role == "u") {
            return redirect()->route('index');
        }

        return view('reservations.setting.date.index')
            ->with('year', $year)
            ->with('all_date', $all_date);
    }

    public function store(Request $request) {
        $request->validate([
            'date' => 'required'
        ]);

        $this->date->date = $request->date;
        $this->date->save();

        return redirect()->back();
    }

    public function edit($id) {
        $date = $this->date->findOrFail($id);
        $year = Carbon::now()->year;

        return view('reservations.setting.date.edit')
            ->with('year', $year)
            ->with('date', $date);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'date' => 'required'
        ]);

        $date = $this->date->findOrFail($id);
        $date->date = $request->date;
        $date->save();

        return redirect()->route('rsv.set.date.index');
    }
}

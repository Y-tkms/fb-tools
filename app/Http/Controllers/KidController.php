<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kid;
use App\Models\Reservation;

class KidController extends Controller
{
    private $kid;
    private $reservation;

    public function __construct(Kid $kid, Reservation $reservation) {
        $this->kid = $kid;
        $this->reservation = $reservation;
    }

    // christmas
    public function addXmas($id) {
        $this->kid->reservation_id = $id;
        $this->kid->save();

        return redirect()->back();
    }

    public function editXmas($id) {
        $kid = $this->kid->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.christmas.index');
        }

        return view('reservations.christmas.kids.edit')->with('kid', $kid);
    }

    public function updateXmas(Request $request, $id) {
        $request->validate([
            'age' => 'nullable|min:0|max:50',
            'info' => 'nullable|min:0|max:10000'
        ]);

        $kid = $this->kid->findOrFail($id);
        $kid->age = $request->age;
        $kid->info = $request->info;
        $kid->save();

        return redirect()->route('rsv.xmas.show', $kid->reservation_id);
    }

    public function destroyXmas($id) {
        $kid = $this->kid->findOrFail($id);
        $kid->delete();

        return redirect()->route('rsv.xmas.show', $kid->reservation_id);
    }

    // new year
    public function addNewYear($id) {
        $this->kid->reservation_id = $id;
        $this->kid->save();

        return redirect()->back();
    }

    public function editNewYear($id, $type) {
        $kid = $this->kid->findOrFail($id);

        if(Auth::user()->role == 'u' || Auth::user()->role == 'em') {
            return redirect()->route('rsv.newyear.show', ['type' => $type]);
        }

        return view('reservations.newyear.kids.edit')
            ->with('kid', $kid)
            ->with('type', $type);
    }

    public function updateNewYear(Request $request, $id, $type) {
        $request->validate([
            'age' => 'nullable|min:0|max:50',
            'info' => 'nullable|min:0|max:10000'
        ]);

        $kid = $this->kid->findOrFail($id);
        $kid->age = $request->age;
        $kid->info = $request->info;
        $kid->save();

        return redirect()->route('rsv.newyear.kid.show', ['id' => $kid->reservation_id, 'type' => $type])->with('type', $type);
    }

    public function destroyNewYear($id, $type) {
        $kid = $this->kid->findOrFail($id);
        $kid->delete();

        return redirect()->route('rsv.newyear.kid.show', ['id' => $kid->reservation_id, 'type' => $type])->with('type', $type);
    }
}

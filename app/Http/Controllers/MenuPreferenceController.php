<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuPreference;

class MenuPreferenceController extends Controller
{
    private $menu_preference;

    public function __construct(MenuPreference $menu_preference) {
        $this->menu_preference = $menu_preference;
    }

    public function create(Request $request) {
        $request->validate([
            'preference' => 'required|min:1|max:50'
        ]);

        $this->menu_preference->name = $request->preference;
        $this->menu_preference->save();

        return redirect()->back();
    }
}

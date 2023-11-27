<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuSection;
use App\Models\MenuPreference;

class MenuSectionController extends Controller
{
    private $menu_section;
    private $menu_preference;

    public function __construct(MenuSection $menu_section, MenuPreference $menu_preference) {
        $this->menu_section = $menu_section;
        $this->menu_preference = $menu_preference;
    }

    public function index() {
        $all_menu_sections = $this->menu_section->all();
        $all_menu_preference = $this->menu_preference->all();

        return view('menu.sections&preferences.sections')
            ->with('all_menu_sections', $all_menu_sections)
            ->with('all_menu_preference', $all_menu_preference);
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);

        $this->menu_section->name = $request->name;
        $this->menu_section->save();

        return redirect()->back();
    }

    public function edit($id, $type) {
        if($type == 'section') {
            $data = $this->menu_section->findOrFail($id);
        } else {
            $data = $this->menu_preference->findOrFail($id);
        }

        return view('menu.sections&preferences.edit')
            ->with('data', $data)
            ->with('type', $type);
    }

    public function update(Request $request, $id, $type) {
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);

        if($type == "section") {
            $data = $this->menu_section->findOrFail($id);
        } else {
            $data = $this->menu_preference->findOrFail($id);
        }

        $data->name = $request->name;
        $data->save();

        return redirect()->route('menu.section');
    }

    public function destroy($id, $type) {
        if($type == "section") {
            $this->menu_section->destroy($id);
        } else {
            $this->menu_preference->destroy($id);
        }

        return redirect()->back();
    }
}

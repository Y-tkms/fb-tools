<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RsvSection;

class RsvSectionController extends Controller
{
    private $rsv_section;

    public function __construct(RsvSection $rsv_section) {
        $this->rsv_section = $rsv_section;
    }

    public function index() {
        return view('reservations.setting.index');
    }

    public function sectionIndex() {
        $all_sections = $this->rsv_section->where('status', 1)->get();

        return view('reservations.setting.sections.index')->with('all_sections', $all_sections);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'max' => 'required|numeric|min:0|max:500'
        ]);

        $this->rsv_section->name = $request->name;
        $this->rsv_section->max = $request->max;
        $this->rsv_section->save();

        return redirect()->back();
    }

    public function edit($id) {
        $section = $this->rsv_section->findOrFail($id);

        return view('reservations.setting.sections.edit')->with('section', $section);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'max' => 'required|numeric|min:0|max:500'
        ]);

        $section = $this->rsv_section->findOrFail($id);
        $section->name = $request->name;
        $section->max = $request->max;
        $section->save();

        return redirect()->route('rsv.set.sec.index');
    }

    public function delete($id) {
        $section = $this->rsv_section->findOrFail($id);

        return view('reservations.setting.sections.delete')->with('section', $section);
    }

    public function deactivate($id) {
        $section = $this->rsv_section->findOrFail($id);
        $section->status = 0;
        $section->save();

        return redirect()->route('rsv.set.sec.index');
    }
}

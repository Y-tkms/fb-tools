<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuSection;
use App\Models\MenuPreference;

class MenuController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'images';
    private $menu;
    private $menu_section;
    private $preference;

    public function __construct(Menu $menu, MenuSection $menu_section, MenuPreference $preference) {
        $this->menu = $menu;
        $this->menu_section = $menu_section;
        $this->preference = $preference;
    }

    public function saveImage($request) {
        $imageName = time() . "." . $request->image->extension();
        $request->image->move(public_path(self::LOCAL_STORAGE_FOLDER), $imageName);

        return $imageName;
    }

    public function deleteImage($image_name) {
        $image_path = public_path(self::LOCAL_STORAGE_FOLDER . "/" . $image_name);

        if(file_exists($image_path)) {
            unlink($image_path);
        }
    }

    public function index() {
        $all_menu = $this->menu->all();
        $all_menu_section = $this->menu_section->all();
        $menu_no_section = $this->menu->where('section_id', null)->get();
        return view('menu.index')
            ->with('all_menu', $all_menu)
            ->with('all_menu_section', $all_menu_section)
            ->with('menu_no_section', $menu_no_section);
    }

    public function create() {
        $all_sections = $this->menu_section->all();
        $all_preference = $this->preference->all();
        return view('menu.create')
            ->with('all_sections', $all_sections)
            ->with('all_preference', $all_preference);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:1|max:100',
            'section' => '',
            'price' => 'max:99999999999',
            'image' => 'mimes:jpg,jpeg,png,gif,heic|max:1048',
            'preference' => '',
            'description' => 'max:50000'
        ]);

        $this->menu->name = $request->name;

        if($request->section) {
            $this->menu->section_id = $request->section;
        }
        if($request->price) {
            $this->menu->price = $request->price;
        }
        if($request->image) {
            $this->menu->image = $this->saveImage($request);
        }
        if($request->preference) {
            $this->menu->preference_id = $request->preference;
        }
        if($request->description) {
            $this->menu->description = $request->description;
        }

        $this->menu->save();

        return redirect()->route('menu.index');
    }

    public function show($id) {
        $menu = $this->menu->findOrFail($id);

        return view('menu.show')->with('menu', $menu);
    }

    public function edit($id) {
        $menu = $this->menu->findOrFail($id);
        $all_sections = $this->menu_section->all();
        $all_preference = $this->preference->all();

        return view('menu.edit')
            ->with('menu', $menu)
            ->with('all_sections', $all_sections)
            ->with('all_preference', $all_preference);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|min:1|max:100',
            'section' => '',
            'price' => 'max:99999999999',
            'image' => 'mimes:jpg,jpeg,png,gif,heic|max:1048',
            'preference' => '',
            'description' => 'max:50000'
        ]);

        $menu = $this->menu->findOrFail($id);
        $menu->name = $request->name;

        if($request->section) {
            $menu->section_id = $request->section;
        }
        if($request->price) {
            $menu->price = $request->price;
        }
        if($request->image) {
            if($menu->image) {
                $this->deleteImage($menu->image);
            }

            $menu->image = $this->saveImage($request);
        }
        if($request->preference) {
            $menu->preference_id = $request->preference;
        }
        if($request->description) {
            $menu->description = $request->description;
        }

        $menu->save();

        return redirect()->route('menu.show', $menu->id);
    }

    public function hideMenu($id) {
        $menu = $this->menu->findOrFail($id);
        $menu->status = 0;
        $menu->save();

        return redirect()->route('menu.index');
    }
}

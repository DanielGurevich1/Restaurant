<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Validator;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus = Menu::all();


        if ($request->sort && 'asc' == $request->sort) {
            $menus = $menus->sortBy('price');
            $sortBy = 'asc';
        } elseif ($request->sort && 'desc' == $request->sort) {
            $menus = $menus->sortByDesc('name');
            $sortBy = 'desc';
        }

        return view('menu.index', [

            'menus' => $menus,
            'filterBy' => $filterBy ?? 0,
            'sortBy' => $sortBy ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'menu_title' => ['required', 'min:3', 'max:64'],
                'menu_price' => ['required'],
                'menu_weight' => ['required'],
            ],
            [
                'menu_title.min' => 'Title is too short - min 3 chars',
                'menu_title.max' => 'Title is too long- max 64 chars'
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $menu = new Menu;
        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;
        $menu->about = $request->menu_about;
        // $menu->save();
        // return redirect()->route('menu.index')->with('success_message', 'Menu was added. Bon Appetit!');

        if ($request->menu_weight >= $request->menu_meat) {
            $menu->save();
            return redirect()->route('menu.index')->with('success_message', 'Menu was created!');
        } else {

            return redirect()->route('menu.index')->with('info_message', 'Menu was not created, as meat weight is too big');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(menu $menu)
    {
        return view('menu.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menu $menu)
    {
        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;
        $menu->about = $request->menu_about;
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'Menu was UPDATED. Cool?!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(menu $menu)
    {
        if ($menu->menuHasRest->count()) {

            return redirect()->route('menu.index')->with('info_message', 'Sorry, you cannot delete this menu.');
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('info_message', 'Menu was deleted. sorry!');
    }
}
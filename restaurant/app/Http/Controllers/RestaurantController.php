<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Http\Request;
use Validator;

class RestaurantController extends Controller
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

        // $menus = Menu::all();
        //FILTRAVIMAS
        if ($request->menu_id) {
            $restaurants  = Restaurant::where('menu_id', $request->menu_id)->get();
            $filterBy = $request->menu_id;
        } else {
            $restaurants = Restaurant::all();
        }



        if ($request->sort && 'asc' == $request->sort) {
            $restaurants = $restaurants->sortBy('title');
            $sortBy = 'asc';
        } elseif ($request->sort && 'desc' == $request->sort) {
            $restaurants = $restaurants->sortByDesc('title');
            $sortBy = 'desc';
        }
        $menus = Menu::all();
        return view('restaurant.index', [
            'restaurants' => $restaurants,
            'menus' => $menus,
            'sortBy' => $sortBy ?? '',
            'filterBy' => $filterBy ?? 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::orderBy('title')->get();
        return view('restaurant.create', ['menus' => $menus]);
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
                'restaurant_title' => ['required', 'min:3', 'max:64'],
                'restaurant_customer' => ['required'],
                'restaurant_employee' => ['required'],
            ],
            [
                'restaurant_title.min' => 'Title is too short - min 3 chars',
                'restaurant_title.max' => 'Title is too long- max 64 chars'
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $restaurant = new Restaurant;
        $restaurant->title = $request->restaurant_title;
        $restaurant->customer = $request->restaurant_customer;
        $restaurant->employee = $request->restaurant_employee;

        $restaurant->menu_id = $request->menu_id;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'Restaurant was added. Bon Appetit!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $menus = Menu::all();

        return view('restaurant.edit', ['restaurant' => $restaurant, 'menus' => $menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->title = $request->restaurant_title;
        $restaurant->customer = $request->restaurant_customer;
        $restaurant->employee = $request->restaurant_employee;

        $restaurant->menu_id = $request->menu_id;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'Restaurant was UPDATED. Come again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {


        $restaurant->delete();
        return redirect()->route('restaurant.index')->with('info_message', 'Restaurant was closed. Find us at our new address in NY!');
    }
}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Restaurant List</div>
                <div class="form-check">
                    <form action="{{route('restaurant.index')}}" method="get" class="form-check">
                        <div class="form-group make-inline">
                            <h5 style="color:orange;">Select menu</h5>
                            <select class="form-control" name="menu_id">
                                <option value="0" disabled @if($filterBy==0) selected @endif>Select menu</option>

                                @foreach ($menus as $menu)
                                <option value="{{$menu->id}}" @if($filterBy==$menu->id) selected @endif> {{$menu->title}} </option>
                                <small class="form-text text-muted">your choice, please</small>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-check-inline list-line">
                            <label class="form-check">Sort by name:</label>

                            <label class="form-check-label" for="sortASC">ASC</label>
                            <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy=='asc' ) checked @endif>

                            DSC <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy=='desc' ) checked @endif>

                            <div class="list-line__buttons">
                                <button type="submit" class="btn btn-info btn-sm">Sort</button>
                                <a href="{{route('restaurant.index')}}" class="btn btn-info btn-sm">Clear sort</a>

                            </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">

                    @foreach ($restaurants as $restaurant)

                    <li class="list-group-item list-line">
                        <div>
                            <h2>{{$restaurant->title}} | {{$restaurant->customer}} seats</h2>
                            <h4>{{$restaurant->restMenu->title}}</h4>
                            <h3>{{$restaurant->restMenu->price}}</h3>
                        </div>
                        {{-- <select class="form-control" name="menu_id">
                            <option value="0" disabled>Select Menu</option>
                            @foreach ($menus as $menu)
                            <option value="{{$menu->id}}">
                        {{$menu->title}} {{$menu->price}}
                        </option>
                        @endforeach
                        </select> --}}

                        <div class="list-line__buttons">
                            <form method="get" action="{{route('restaurant.edit', [$restaurant])}}">
                                <button style="{{route('restaurant.edit',[$restaurant])}}" class="btn btn-outline-primary btn-sm">Edit</button>
                                @csrf
                            </form>
                            <form method="post" action="{{route('restaurant.destroy', [$restaurant])}}">

                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                @csrf
                            </form>

                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

{{-- @if($filterBy==0) selected @endif --}}
{{-- @if($filterBy==$menu->id) selected @endif --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 style="color:red;">Menu list</h2>
                <form action="{{route('menu.index')}}" method="get" class="make-inline">
                    <div class="form-group make-inline">
                        <h5 style="color:orange;">Sort by price</h5>
                        {{-- <select class="form-control" name="menu_id">
                            <option value="0" disabled @if($filterBy==0) selected @endif>Select specie</option>

                            @foreach ($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}" @if($filterBy==$restaurant->id) selected @endif> {{$restaurant->title}} </option>
                        <small class="form-text text-muted">your choice, please</small>
                        @endforeach
                        </select> --}}
                    </div>
                    <div class="form-group make-inline">
                        <div class="form-check">

                            <input class="form-check-input" type="radio" name="sort" value="asc" @if($filterBy=='asc' ) checked @endif id="sortBy">
                            <label class="form-check-label" for="sortBy">price</label>

                        </div>
                        <div class="form-check check">
                            <input class="form-check-input" type="radio" name="sort" value="desc" @if($filterBy=='asc' ) checked @endif id="sortByDesc">
                            <label class="form-check-label" for="sortByDesc">name</label>


                        </div>

                    </div>
                    <div class="list-line__buttons">
                        <button type="submit" class="btn btn-info">Filter</button>
                        <a href="{{route('menu.index')}}" class="btn btn-info">Clear filter</a>
                    </div>
                </form>
            </div>


            <div class="card-body">
                <ul class="list-group">

                    @foreach ($menus as $menu)

                    <li class="list-group-item list-line">
                        <div>
                            <h2>{{$menu->title}}</h2> | {{$menu->price}} Euro | {{$menu->weight}} gr.| {{$menu->meat}} gr. of meat | {!!$menu->about!!}
                        </div>

                        <div class="list-line__buttons">
                            <form method="get" action="{{route('menu.edit', [$menu])}}">
                                <button style="{{route('menu.edit',[$menu])}}" class="btn btn-outline-primary btn-sm">Edit</button>
                                @csrf
                            </form>
                            <form method="post" action="{{route('menu.destroy', [$menu])}}">

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

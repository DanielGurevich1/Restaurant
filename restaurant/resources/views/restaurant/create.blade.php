@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Restaurant</div>

                <div class="card-body">
                    <form method="POST" action="{{route('restaurant.store')}}">

                        <div class="form-group">
                            <label> Title:</label>
                            <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title')}}">
                            <small class="form-text text-muted">enter a title, please</small>
                        </div>
                        <div class="form-group">
                            <label> Places in restaurant:</label>
                            <input type="text" class="form-control" name="restaurant_customer" value="{{old('restaurant_customer')}}">
                            <small class="form-text text-muted">enter seat number, please</small>
                        </div>
                        <div class="form-group">
                            <label> Employees:</label>
                            <input type="text" class="form-control" name="restaurant_employee" value="{{old('restaurant_employee')}}">
                            <small class="form-text text-muted">enter employees number, please</small>
                        </div>
                        <div class="form-group">
                            <label> Select menu:</label>
                            <select name="menu_id">
                                @foreach ($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->title}} {{$menu->price}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">your choice, please</small>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-outline-primary btn-sm">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

</script>

@endsection

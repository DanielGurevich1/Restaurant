@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Restaurant</div>

                <div class="card-body">
                    <form method="POST" action="{{route('restaurant.update', [$restaurant->id])}}">

                        <div class="form-group">
                            <label> Title:</label>
                            <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title',$restaurant->title)}}">
                            <small class="form-text text-muted">enter a title, please</small>
                        </div>
                        <div class="form-group">
                            <label> Places in restaurant:</label>
                            <input type="text" class="form-control" name="restaurant_customer" value="{{old('restaurant_custoner',$restaurant->customer)}}">
                            <small class="form-text text-muted">enter seat number, please</small>
                        </div>
                        <div class="form-group">
                            <label> Employees:</label>
                            <input type="text" class="form-control" name="restaurant_employee" value="{{old('restaurant_employee',$restaurant->employee)}}">
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
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Edit</button>
                    </form>

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

@extends('layouts.dashboard')

@section('content')



<form action="{{route('category.update', $category->id)}}" method="post" class="w-100 p-5" enctype="multipart/form-data" >
    @csrf
    

    <div class="container">
        <div class="row">
            <div class="form-group col-md-12 mt-1">
                <label for="name">name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{$category->name}}">
            </div>


            <!-- //! وقفه هنا -->
            <div class="form-group col-md-8 mt-1">
                <label for="parent_id">parent_id</label>
                <select id="parent_id" name="parent_id" class="form-control">
                    <option value="">main</option>
                    @foreach ($parent_id as $parent)
                    <option value="{{$parent->id}}" @selected($parent->id == $category->parent_id)>{{$parent->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4 mt-1 d-flex align-items-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="Active" value="Active" @checked($category->status == "Active")>
                    <label class="form-check-label" for="Active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="Inactive" value="Inactive" @checked($category->status == "Inactive")>
                    <label class="form-check-label" for="Inactive">Inactive</label>
                </div>
            </div>

            <div class="form-group col-md-6 mt-1">
                <label for="image">image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group col-md-6 mt-1">
                <label for="logo">logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-success w-100 mt-5">Update NoW</button>
</form>
@endsection
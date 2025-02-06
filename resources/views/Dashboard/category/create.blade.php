@extends('layouts.dashboard')

@section('content')

<style>
    .form-control.is-invalid::placeholder {
        color: red;
        /* اللون الأحمر */
        opacity: 1;
        /* التأكد من أن الـ placeholder مرئي */
        font-size: 13px;
        
    }
</style>

<form action="{{route('category.store')}}" method="post" class="w-100 p-5" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">

            <!-- component -->
             {{-- old('name') => function returnt old the value  --}}
            <x-form.input type="text" name="name" value="{{old('name')}}" /> 

            <!-- <div class="form-group col-md- mt-1">
                <label for="name">name</label>
                <input type="text" class="form-control  @error('name') is-invalid  @enderror" id="name" name="name" placeholder=" @error('name') {{$message}} @else name @enderror">
            </div> -->

            @error('name')
            <span class="text-danger">
                {{ $message }}
            </span>
            @enderror

            <!-- //! وقفه هنا -->
            <div class="form-group col-md-8 mt-1">
                <label for="parent_id">parent_id</label>
                <select id="parent_id" name="parent_id" @class([ 'form-control' , 'is-invalid'=> $errors->has('parent_id'),
                    ])>
                    <option selected value="">main</option>
                    @foreach ($parent_id as $parent)
                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                    @endforeach
                </select>
                @error('parent_id')
                <span class="text-danger" >
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group col-md-4 mt-1 d-flex align-items-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="Active" value="Active">
                    <label class="form-check-label" for="Active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="Inactive" value="Inactive">
                    <label class="form-check-label" for="Inactive">Inactive</label>
                </div>
                @error('status')
                <span class="text-danger" >
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group col-md-6 mt-1">
                <label for="image">image</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                <span class="text-danger" >
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group col-md-6 mt-1">
                <label for="logo">logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-success w-100 mt-5">Create Now</button>
</form>
@endsection
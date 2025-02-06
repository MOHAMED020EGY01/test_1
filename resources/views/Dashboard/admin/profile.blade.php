@extends('layouts.dashboard')

@section('content')

<x-alert type="success" message="session('success')" />

<form action="{{route('profile.update')}}" method="post" class="w-100 p-5 form-control" enctype="multipart/form-data">
    @csrf


    <div class="container">
        <div class="row">
            <x-form.input name="frist_name" value="{{old('frist_name',$userProfile->profile->frist_name)}}" />
            <x-form.input name="last_name" value="{{$userProfile->profile->last_name}}" />

            <div class="form-group col-md-6 mt-1">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="gender" value="male" class="custom-control-input" @checked($userProfile->profile->gender == 'male')>
                    <label class="custom-control-label" for="customRadioInline1">Male</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="gender" value="female" class="custom-control-input" @checked($userProfile->profile->gender == 'female')>
                    <label class="custom-control-label" for="customRadioInline2">Female</label>
                </div>
            </div>

            <select name="country" class="form-select" aria-label="Default select example">
                @foreach ( $countryes as $country => $name)
                <option value="{{$country}}" @selected($country == $userProfile->profile->country)>{{$name}}</option>
                @endforeach
            </select>


            <button type="submit" class="btn btn-success w-100 mt-5">Update NoW</button>
        </div>
    </div>
</form>
@endsection
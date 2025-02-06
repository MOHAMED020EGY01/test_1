@extends('layouts.dashboard')

@section('content')

<style>
    /* إضافة فواصل بين الأعمدة */
    table {
        border-collapse: collapse;
        /* علشان الحدود تكون متصلة */
        width: 100%;
    }

    th,
    td {
        border-right: 1px solid #ddd;
        /* خط فاصل بين الأعمدة */
        padding: 8px;
        /* إضافة مساحة داخلية */
        text-align: center;
        vertical-align: middle;
    }

    th:last-child,
    td:last-child {
        border-right: none;
        /* إزالة الخط الفاصل من العمود الأخير */
    }
</style>

<!-- session('success') -->

{{--كمبونت اقدر ابعت لها متغيرات --}}
<x-alert type="success" message="session('success')" />


<div class="btn-toolbar mb-3 mb-md-0">
    <a href="{{route('category.create')}}" class="btn btn-primary">Add new category</a>
    <a href="{{route('category.trash')}}" class="btn btn-primary">Trash</a>
</div>


    <form action="{{URL::current()}}" method="get">
        <div class="d-flex justify-content-between">

            <input type="text" name="search" class="form-control m-2 " value="{{$search ?? ''}}">
            <select name="status" class="form-control m-2 " id="">
                <option value="">All</option>
                <option value="active">active</option>
                <option value="inactive">inactive</option>
            </select>
            <button type="submit" class="btn btn-primary m-2">search</button>
        </div>
    </form>


<div style="overflow-x:auto;">
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>slug</th>
                <th>parent_id</th>
                <th>Number Product</th>
                <th>status</th>
                <th>image</th>
                <th>logo</th>
                <th>create_at</th>
                <th colspan="3">Operations</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->count())
            @foreach ($categories as $category )
            <tr>
                <td>{{$category->id}}</td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;"><a href="{{route('category.show', $category->id)}}">{{$category->name}}</a></td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;">{{$category->slug}}</td>
                <td>{{$category->parent->name}}</td>
                <td>{{$category->counteProduct}}</td>
                <td>{{$category->status}}</td>
                <td>
                    <img width="75" src={{asset("images/public/".$category->image)}} alt="image">
                </td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;">{{$category->logo}}</td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;">{{$category->created_at}}</td>
                <td><a href={{route('category.edite', ['id'=>$category->id,'edite'=>'yes'])}} class="btn btn-sm btn-primary">edite</a></td>
                <td>
                    <form action="{{route('category.destroy', $category->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <td colspan="9"> NO category founded</td>
            @endif
        </tbody>
    </table>
    {{$categories->withQueryString()->links('Dashboard.category.pagination.custom')}}
</div>

@endsection
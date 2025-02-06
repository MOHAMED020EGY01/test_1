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

    <a href={{route('category.index')}} class="btn btn-info ml-3">back</a>
    <div style="overflow-x:auto;">
    <div class="btn-toolbar mb-3 mb-md-0">{{$category->count()}}</div>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>slug</th>
                <th>status</th>
                <th>image</th>
                <th>logo</th>
                <th>create_at</th>
                <th>delete_at</th>
                <th colspan="2">Operations</th>
            </tr>   
        </thead>
        <tbody>
            @if ($category->count())
            @foreach ($category as $categorye )
            <tr>
                <td>{{$categorye->id}}</td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;">{{$categorye->name}}</td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;">{{$categorye->slug}}</td>
                <td>{{$categorye->status}}</td>
                <td>
                    <img width="75" src={{asset("images/public/".$categorye->image)}} alt="image">
                </td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;">{{$categorye->logo}}</td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;">{{$categorye->created_at}}</td>
                <td style="max-width: 150px; overflow-x: auto; white-space: nowrap;">{{$categorye->deleted_at}}</td>
                <td>
                    <form action="{{route('category.restore', $categorye->id)}}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-danger">Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('category.forceDelete', $categorye->id)}}" method="post">
                        @csrf
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
    {{$category->withQueryString()->links('Dashboard.category.pagination.custom')}}
</div>

@endsection
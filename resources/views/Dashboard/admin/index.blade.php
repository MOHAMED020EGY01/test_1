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

    .coldesien {
        max-width: 150px;
        overflow-x: auto;
        white-space: nowrap;
    }
</style>

<!-- session('success') -->

{{--كمبونت اقدر ابعت لها متغيرات --}}
<x-alert type="success" message="session('success')" />


<div class="btn-toolbar mb-3 mb-md-0">
    <a href="{{route('user.create')}}" class="btn btn-primary">Add new user</a>
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
                <th>store_id</th>
                <th>email</th>
                <th>Phone</th>
                <th>role</th>
                <th>create_at</th>
                <th colspan="3">Operations</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count())
            @foreach ($users as $user )
            <tr>
                <td>{{$user->id}}</td>
                <td class="coldesien">{{$user->name}}</td>
                <td class="coldesien">{{$user->store_id}}</td>
                <td class="coldesien">{{$user->email}}</td>
                <td class="coldesien">{{$user->Phone}}</td>
                <td class="coldesien">{{$user->role}}</td>
                <td class="coldesien">{{$user->created_at}}</td>
                <td><a href={{route('user.edite', ['id'=>$user->id,'edite'=>'yes'])}} class="btn btn-sm btn-primary">edite</a></td>
                <td>
                    <form action="{{route('user.destroy', $user->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <td colspan="9"> NO user founded</td>
            @endif
        </tbody>
    </table>

</div>
{{$users->withQueryString()->links('Dashboard.category.pagination.custom')}}

@endsection
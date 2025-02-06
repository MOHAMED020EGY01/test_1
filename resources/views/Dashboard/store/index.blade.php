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
    <a href="{{route('store.create')}}" class="btn btn-primary">Add new store</a>
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
                <th>state</th>
                <th>image</th>
                <th>logo</th>
                <th>create_at</th>
                <th colspan="3">Operations</th>
            </tr>
        </thead>
        <tbody>
            @if ($stores->count())
            @foreach ($stores as $store )
            <tr>
                <td>{{$store->id}}</td>
                <td class="coldesien">{{$store->name}}</td>
                <td class="coldesien">{{$store->slug}}</td>
                <td class="coldesien">{{$store->parent_id}}</td>
                <td class="coldesien">{{$store->state}}</td>
                <td><img width="75" src={{asset("images/public/".$store->image)}} alt="image"></td>
                <td class="coldesien">{{$store->logo}}</td>
                <td class="coldesien">{{$store->created_at}}</td>
                <td><a href={{route('store.edite', ['id'=>$store->id,'edite'=>'yes'])}} class="btn btn-sm btn-primary">edite</a></td>
                <td>
                    <form action="{{route('store.destroy', $store->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <td colspan="9"> NO store founded</td>
            @endif
        </tbody>
    </table>

</div>
{{$stores->withQueryString()->links('Dashboard.category.pagination.custom')}}

@endsection
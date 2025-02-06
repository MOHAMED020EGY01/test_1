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
    <a href="{{route('product.create')}}" class="btn btn-primary">Add new product</a>
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
                <th>stores_id</th>
                <th>category_id</th>
                <th>description</th>
                <th>quantity</th>
                <th>price</th>
                <th>compare_price</th>
                <th>options</th>
                <th>rating</th>
                <th>featured</th>
                <th>state</th>
                <th>image</th>
                <th>logo</th>
                <th>video</th>
                <th>create_at</th>
                <th colspan="3">Operations</th>
            </tr>
        </thead>
        <tbody>
            @if ($products->count())
            @foreach ($products as $product )
            <tr>
                <td>{{$product->id}}</td>
                <td class="coldesien">{{$product->name}}</td>
                <td class="coldesien">{{$product->slug}}</td>
                <!-- 
                    في علاقه مع الريليشن يتم استخدام الفاكشن زيها زي متغير من دون اقواس 
                    $product->store->name
                    طيب لو هستخدم الاقواس لي اي سبب اعمل ايه 
                    $product->store()->first()->name
                    first() نستخدم داله 
                -->
                <td class="coldesien">{{$product->store()->first()->name}}</td>
                <td class="coldesien">{{$product->category->name}}</td>

                <td class="coldesien">{{$product->description}}</td>
                <td class="coldesien">{{$product->quantity}}</td>
                <td class="coldesien">{{$product->price}}</td>
                <td class="coldesien">{{$product->compare_price}}</td>
                <td class="coldesien">{{$product->options}}</td>
                <td class="coldesien">{{$product->rating}}</td>
                <td class="coldesien">{{$product->featured}}</td>
                <td class="coldesien">{{$product->state}}</td>
                <td><img width="75" src={{asset("images/public/".$product->image)}} alt="image"></td>
                <td class="coldesien">{{$product->logo}}</td>
                <td class="coldesien">{{$product->video}}</td>
                <td class="coldesien">{{$product->created_at}}</td>
                <td><a href={{route('product.edite', $product->id)}} class="btn btn-sm btn-primary">edite</a></td>
                <td>
                    <form action="{{route('product.destroy', $product->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <td colspan="9"> NO product founded</td>
            @endif
        </tbody>
    </table>

</div>
{{$products->withQueryString()->links('Dashboard.category.pagination.custom')}}

@endsection
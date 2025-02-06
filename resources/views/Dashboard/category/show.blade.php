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
<div style="overflow-x:auto;">

    <table class="table">
        <thead>
            <tr>
                    <th>name</th>
                    <th>slug</th>
                    <th>stores_id</th>
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
            </tr>
        </thead>
        <tbody>
            @php
            $products = $category->products()->with('store')->paginate(3);
            @endphp
            @foreach ($products as $product )
            <tr>
                    <td class="coldesien">{{$product->name}}</td>
                    <td class="coldesien">{{$product->slug}}</td>
                    <td class="coldesien">{{$product->store->name}}</td>
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
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$products->withQueryString()->links('Dashboard.category.pagination.custom')}}
</div>

@endsection
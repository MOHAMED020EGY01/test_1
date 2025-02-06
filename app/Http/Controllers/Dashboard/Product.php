<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product as ModelsProduct;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Product extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ModelsProduct::with(['category','store'])->paginate(5);
        return view("Dashboard.product.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = ModelsProduct::findOrFail($id);
        $tags = $product->tags()->pluck('name')->toArray();
        return view("Dashboard.product.edit", compact("product","tags"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = ModelsProduct::findOrFail($id);
        $tags = json_decode($request->post('tags'));
        $tagIds = [];
        $saved_tags = Tag::all();
        
        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name->value);
            $tag = $saved_tags->where('slag', $slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    'name' => $t_name->value,
                    'slag' => $slug,            
                ]);
            }
            $tagIds[] = $tag->id;
        }

        // Update tags
        $product->tags()->sync($tagIds);

        $product->update($request->all());
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category as ModelsCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     */


     // @@
     // !
     // ? 
     // todo 
     // *
     // //

/**
 * 
 * Join 
 * 
 * SELECT 
 */

    public function index(Request $request)
    {

        //$categories = ModelsCategory::filtersModel($request->query())
        // ->latest("nameCol")// يعمل ترتيب عكسي يعني من كبير الي صغير 
        //orderBy("nameCol",ASC //DESC)//ترتيب العادي 
        //->paginate(10); // Return Collection object  || يشتغل ابوجيكت و ارري في نفس الوقت 
        $categories = ModelsCategory::with(['parent'])
        // ->select('categories.*')
        // ->selectRaw('(SELECT COUNT(*) FROM products where Category_id = categories.id) as products_count')
        ->withCount(['products as counteProduct'])
        ->filtersModel($request->query())
        ->paginate(10);

        

        /**
         * 
         *   ->select('categories.*')
         *    ->selectRaw('(SELECT COUNT(*) FROM products where Category_id = categories.id) as products_count')
         * ديه طريقه اجيب فيها عدد المنجات في كل قسم يوجد طريقه اخري 
         * 
         * ->withCount('NameCol Min')
         * 
         * بتعمل نفس الحاجه بس اهي طريقه اسهل 
         */
        /**
         * SoftDelete
         * 
         * withTrashed() // يرجع كل البيانات حتي المحذوفه
         * onlyTrashed()// المحذوف فقط
         */
        return view("Dashboard.category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent_id = ModelsCategory::all();
        return view("Dashboard.category.create", compact("parent_id"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //! طريق وصول الي الداتا 

        // $request->input('name');
        // $request->post('name');

        /**
         * 
         * !طريقة اوله 
         *              *طريقة تخزين في داتا بيز 
         *
         *         $category = new ModelsCategory;
         *           $category->name = $request->post('name'); // $name = $request->name;
         *           $category->slug = $request->post('slug');
         *           $category->parent_id = $request->post('parent_id');
         *           $category->status = $request->post('status');
         *           $category->image = $request->post('image');
         *           $category->logo = $request->post('logo');
         *           $category->save();
         */
        //! طريقة ثانيه 
        //  $category = new ModelsCategory([
        //     "name"=> $request->post("name"),
        //     "slug"=> $request->post("slug"),
        //     "parent_id"=> $request->post("parent_id"),
        //     "status"=> $request->post("status"),
        //     "image"=> $request->post("image"),
        //     "logo"=> $request->post("logo"),
        //  ]);
        //  $category->save();

        //! طريقة ثالثه 
        // $category =  ModelsCategory::create($request->all());
        /*
                $file->getClientOriginalName(); //! return file name
                $file->getSize();//! return file size byite
                $file->getClientOriginalExtension();//! return file extension
                $file->getMimeType();//! return file mime type   image/png
         */


         /**
          *  vallidateCategoryModel in model => Category

          // and change the massge in validation


          :attribute => name variable in validation 
          */
        
          $request->validate(ModelsCategory::vallidateCategoryModel(),[
            'required' => 'The :attribute field is required and must be unique',
            'unique' => 'The :attribute field already exists',
            'image.mimes' => 'The :attribute field must be a file of type: jpg, jpeg, png',
          ]);

        // make slug 
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);
        /**
         * @var mixed
         * 
         * change name the image
         */
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileNameWithoutExtension = $file->getClientOriginalName();
            $name = 'image_name_' . Str::slug($fileNameWithoutExtension) . '-' . 'Data-upload_at_' . now()->format('Y_m_d_H_i_s') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('CreateImage', $name, [ //storeAs => to change name file 
                'disk' => 'uploads',
            ]);
            $data['image'] = $path;
        }

        //! طريقة رابعه
        $category = new ModelsCategory($data);
        $category->save();

        //PRG
        return redirect()->route("category.index")
            ->with(['success' => 'Category Created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = ModelsCategory::findOrFail($id);
        } catch (Exception) {
            return redirect()->route('404.notfound');
        }
        return view('Dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $category = ModelsCategory::findOrFail($id);
        } catch (Exception) {
            return redirect()->route('404.notfound');
        }
        // SELECT * FROM categories WHERE id <> $id AND (parent_id IS NULL OR parent_id <> $id)
        $parent_id = ModelsCategory::where('id', '<>', $category->id)
            ->where(function ($query) use ($id) {
                $query
                    ->whereNull('parent_id')
                    ->orwhere('parent_id', '<>', $id);
            })
            ->get();
        return view("Dashboard.category.edite", compact("category", "parent_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $category = ModelsCategory::findOrFail($id);
            $old_image = $category->image;
            $request->validate(ModelsCategory::vallidateCategoryModel($id));
        } catch (Exception) {
            return redirect()->route('404.notfound');
        }

        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        
        /*
                change name the image 
        */
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileNameWithoutExtension = $file->getClientOriginalName();
            $name = 'image_name_' . Str::slug($fileNameWithoutExtension) . '-' . 'Data-upload_at_' . now()->format('Y_m_d_H_i_s') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('CreateImage', $name, [ //storeAs => to change name file 
                'disk' => 'uploads',
            ]);
            $data['image'] = $path;
        }
        
        /*
            update Data 
        */
        $category->update($data);
        if ($request->hasFile('image')) {
            /*
                Delete the old image
            */
            if ($old_image && $data['image']) {
                Storage::disk('uploads')->delete($old_image);
            }
        }

        return redirect()->route("category.index")->with("success", "Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /** //! طريقة اولى */
        try {
            $category = ModelsCategory::findOrFail($id);

            // $old_image = $category->image;
            // if ($old_image) {
            //     Storage::disk('uploads')->delete($old_image);
            // }
        } catch (Exception) {
            return redirect()->route('404.notfound');
        }
        $category->delete();

        /** //! طريقة الثانية  */
        # ModelsCategory::destroy($id);
        return redirect()->route("category.index")->with("deleted", "Category Deleted Successfully");
    }

/**
 * 
 * @tra
 * 
 */

    public function trash(){
        $category = ModelsCategory::onlyTrashed()->paginate(10);
        return view("Dashboard.category.trash", compact("category"));
    }

    public function restore( $id){
        $category = ModelsCategory::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route("category.trash")
        ->with("deleted", "Category restore Successfully");
    }
    public function forceDelete($id){
        $category = ModelsCategory::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route("category.trash")
        ->with("deleted", "Category forceDelete Successfully");
    }
}

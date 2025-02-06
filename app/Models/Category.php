<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    // SoftDeletes ** يعملي سله مهملات 
    use HasFactory, SoftDeletes;





    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'status',
        'image',
        'logo',
    ];
    // Local Scope
    public function scopefiltersModel(Builder $builder, $filters) // scope اي اسكوب لازم يبداء ب كلمه 
    {

        $builder->when($filters['search'] ?? false, function ($builder, $value) {
            $builder->where("name", "like", "%$value%");
        });
        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where("status", "=", $value);
        });

        //! نفس الموضوع 

        /*
        if($filters['search'] ?? false){
            $builder->where("name","like","%{$filters['search']}%");
        }
        if($filters['status'] ?? false){
            $builder->where("status","=",$filters['status']);
        }

        */
    }

    // this step write validation in model
    public static function vallidateCategoryModel($id = 0)
    {
        return [

            "name" => "required|string|min:3|max:255|unique:categories,name,$id",
            "parent_id" => "nullable|int|exists:categories,id",
            "image" => "mimes:jpg,jpeg,png|max:2048",
            "status" => "required|in:Active,Inactive",
        ];
    }

    // بناء العلاقات 

    /**
     * 
     * 1 to 1 
     * 
     * 1 to min 
     * min to min 
     */

    /*************  🌟 Relation 🌟  *************/
    /**
     * Summary of Product
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @return 1 to min
     */
    public function products()
    {
        /**
         * بطريقه اخري 
         *  return $this->hasMany('App\Models\Product','category_id','id')
         */
        // Add your function logic here
        return $this->hasMany(Product::class, 'category_id', 'id'); // ارجع من هنا اسم المودل 

    }
    // مشكلة طريقه الريليشن هي انه برنامج هيكون ابطاء مع زيادة المنتجات 

    /**
     * 
     * الحل هو استخدام 
     * with(['nameRelation1','nameRelation2']) in controller 
     */
    /**
     * 
     * مثال 
     * 
     * Product::with(['category','store'])->paginate(5)
     */


    /******   🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟 *******/


    /*************  🌟 Relation 🌟  *************/
    /**
     * Summary of Parent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @return 1 to min
     * in the same table 
     */
    //
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->withDefault(["name" => "-"]);
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}

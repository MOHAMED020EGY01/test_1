<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slag',
        'stores_id',
        'category_id',
        'description',
        'quantity',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'state',
        'image',
        'logo',
        'video',
    ];
    /**
     * loacl scope Active 
     * 
     */
    public function scopeActive(Builder $builder)
    {
        $builder->where('state', '=', 'Active');
    }
    //Glopal Function 
    // lib FakerPHP 
    protected static function booted() // بيشتغل لما موديل بستخدم 
    {                                   // اي اسم نكتبه 
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->role === 'admin') {
                return;
            } elseif ($user) {
                $builder->where('stores_id', '=', $user->store_id);
            }
        });
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
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @return 1 to min
     */
    public function category()
    {
        /**
         * بطريقه اخري 
         *  return $this->belongsTo('App\Models\Category','category_id','id');
         */
        // Add your function logic here
        return $this->belongsTo(Category::class, 'category_id', 'id'); // ارجع من هنا اسم المودل 

    }

    public function store()
    {
        /**
         * بطريقه اخري 
         *  return $this->belongsTo('App\Models\Store','store_id','id');
         */
        // Add your function logic here
        return $this->belongsTo(Store::class, 'stores_id', 'id'); // ارجع من هنا اسم المودل 

    }

    /******   🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟 *******/


    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id'
        );
    }

    /***
     * 
     * Acessors 
     * 
     * get...rAttribute
     * 
     */

    public function getImageUrlAttribute()
    {

        // if (!$this->image) {
        return 'https://www.graspengineering.com/wp-content/themes/merlin/images/default-slider-image.png';
        // }
        // if (Str::startsWith($this->image, ['http', 'https'])) {
        //     return $this->image;
        // }
        // return asset('images/public/' . $this->image);
    }
    /**
     * Calculates the discount percentage for the product
     *
     * @return int
     */
    public function getDescountAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price),1);
    }
}

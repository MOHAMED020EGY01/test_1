<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'status',
        'image',
        'logo',
    ];
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
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         * @return 1 to min
         */
        public function product()
        {
            /**
             * بطريقه اخري 
             *  return $this->belongsTo('App\Models\Product','store_id','id');
             */
            // Add your function logic here
            return $this->hasMany(Product::class,'store_id','id');// ارجع من هنا اسم المودل 
        }
    
        /******   🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟🌟 *******/
}

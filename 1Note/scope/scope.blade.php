{{

عبارة عن طريقه بطبق جمل معينه علي #ddd
كويري بلدير 


// namespace
use Illuminate\Database\Eloquent\Builder;
// Model داخل ملف 
public function scopeActive(Builder $builder)// scope اي اسكوب لازم يبداء ب كلمه 
    {
        $builder->where('status', '=','Inactive');// مثال 
    }
    // where('status', '=','Inactive') الفائده بدل ما كل مره استخدم شرط ده 
    // اقدر استخدم الفاكشن بس 


//! index  داخل فاكشن 

$categories =ModelsCategory::Active()->paginate(2); // Return Collection object  || يشتغل ابوجيكت و ارري في نفس الوقت 

// في 
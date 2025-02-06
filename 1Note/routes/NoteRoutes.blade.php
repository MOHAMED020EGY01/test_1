{{

// the namespace of the route
use Illuminate\Support\Facades\Route;

//! simple Route

//? not need Controller 

Route::get('/greeting', function () {
    return 'Hello World';
});


//? need define controller 
use App\Http\Controllers\UserController;

Route::get('user',[UserController::class,'index']);

=============================================

//! the default Route file
//?directory. These files are automatically loaded by your application's 

 'App\Providers\RouteServiceProvider'

==========================================

All Route method --


Route::get($url, [$controller],$action);
Route::post($url, [$controller],$action);
Route::put($url, [$controller],$action);
Route::patch($url, [$controller],$action);
Route::delete($url, [$controller],$action);
Route::options($url, [$controller],$action);



//* معا  post get  بعض المثود بتبقي محتاج 


Route::match(['get', 'post'], '/', function () {
    // ...
});
 
Route::any('/', function () {
    // ...
});


====================================
//!Redirect Route 



Route::redirect('/here', '/there');

//?Default Route = 302

مثال 
// about page 
Route::get('/about', function () {
    return "This is the About page!";
});


//aboute-us page
Route::get('/about-us', function () {
    return "This is the About-us page!";
});

//aboute-us هيحول ديركت الي  about اي حد هيدخل علي رابط بتاع صحفة 
Route::redirect('/about', '/about-us', 302);

//? 301 ==> Permanent Redirect
//? 302 ==> Temporary Redirect

=====================================================
View Routes

//? اختصار بسيط للروت
//* لو الهدف منه هو العرض 
Route::view('/welcome', 'welcome');

//! مكان ده 
Route::get('/', function () {
    return view('welcome');
});

===========================================
the Route List 

//? php artisan route:list // عرض قائمة بسيطة للروت العندي --

//? php artisan route:list -v // يعرض تفاصيل اكثر 

//? php artisan route:list -vv // اكثر فا اكثر 

//? php artisan route:list --path=api  //show routes api 

//? php artisan route:list --except-vendor

//? php artisan route:list --only-vendor 
==============================================

Route Parameters --

Route::get('/user/{id}', function (string $id) {
    return 'User '.$id;
});


=======================================================

Regular Expression Constraints --

Route::get('/user/{name}', function (string $name) {
    // ...
})->where('name', '[A-Za-z]+');

// مثال 
Route::post('/category/edite/{id}',[Category::class,'update'])->where('id','50')->name('update');
//  خمسين فقط   id في هذا المثال انا حددت انه يعمل ابضيت علي العنصر ال عنده 

//todo | اقدر اضيف اكثر من عنصر 
Route::post('/category/edite/{id}/{name}',[Category::class,'update'])
->where('id'=>'[0-9]+','name' => '[a-z]+')
->name('update');


//? where جميع انواع 
/*!*
    where //بشكل عام
    whereNumber // number only 
    whereAlpha // a-z
    whereAlphaNumeric // number && a-z Not chracters 
    whereUuid //? (Universal Unique Identifier)  => e8400-e29b-41d4-a716-446655440000 => 32
    whereUlid //? (Universally Unique Lexicographically Sortable Identifier) => ARZ3NDEKTSV4RRFFQ69G5FAV => 26
    whereIn // قيم محدده مسبقا 
 */

 ==========================================

 Global Constraints 

 /**
 * Define your route model bindings, pattern filters, etc.
 */
public function boot(): void
{
    Route::pattern('id', '[0-9]+');
}

Route::get('/user/{id}', function (string $id) {
    // Only executed if {id} is numeric...
});
============================================

Encoded Forward Slashes

1) Route::get('/category/edite/{id}',[Category::class,'edit'])->name('edite');

2) Route::get('/category/edite/{id}',[Category::class,'edit'])->name('edite')->where('id','.*'); // لازم براميتر يتبعت


//todo ما الفرق بين 1 ,2  

لو المستخدم دخل #

/category/edite/{id}/hello 

في سطر 
1) هيطبع ايرور 

2) هيشوفها عدية و يتخطاها 

ولكن لازم تكون بنفس المسار يعني مش تكون كده 

/category/hello/edite/{id}
مثلا 

==========================================================

Named Route 

Route::get('/user/profile', function () {
    // ...
})->name('profile');


Route::get('/user/profile',[UserProfileController::class, 'show'])->name('profile');

//? كل ما في الامر ان انا لما احب استخدم المسار ده مش محتاج اكتب المسار كله يكفي اسمه فقط 

//! Route names should always be unique.

==========================================================

Generating URLs to Named Routes 



Route::get('/profile', function () {
    return view('profile');
})->name('profile');


// Generating URLs...
$url = route('profile');

//? كلهم زي بعض 
// Generating Redirects...

return redirect()->route('profile');

return redirect(route('profile'));
 
return to_route('profile');


//* و ممكن ابعت متغير او بيانات الي روت ال انا رايح اليه #

Route::get('/user/{id}/profile', function (string $id) {
    // ...
})->name('profile');


<td>
<a href={{route('category.edite',
 ['id'=>$category->id,'edite'=>'yes'])}}
class="btn btn-sm btn-primary">edite</a>
</td>

url = '/category/edite/{id}?edite=yes'

==========================================================

Inspecting the Current Route





==========================================================

Route Groups


==========================================================

Middleware

==========================================================

Controllers

==========================================================

Subdomain Routing

==========================================================

Route Prefixes

==========================================================
Route Name Prefixes

==========================================================

Route Model Binding


==========================================================

Implicit Binding

==========================================================


Soft Deleted Models

==========================================================

Custoizing the key

==========================================================

Custom Keys and Scoping

==========================================================

Customizing Missing Model Behavior

==========================================================

Implicit Enum Binding

==========================================================

Explicit Binding

==========================================================

Customaizing the Resolution Logic


==========================================================

Fallback Route

==========================================================

Rate Limiting

Defining Rate Limaiters

==========================================================


Segmenting Rate Limits

==========================================================

Multiple Rate Limits

==========================================================

Attraching Rate Limiters to Routes

==========================================================


Throtting With Redis
==========================================================

From Method Spoofing

==========================================================


Accessing the Current Route


==========================================================

Cross-Origin Resource Sharing (CORS)

==========================================================

Route Caching

//? Using the route cache 
//? will drastically decrease 
//? the amount of time it takes to register
//? all of your application's routes. To generate a route

//! php artisan route:cache 

//? You may use the route:clear command to clear the route cache: #

//! php artisan route:clear
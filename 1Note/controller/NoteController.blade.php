{{

//*Create New Controller
//? php artisan make:controller NameController

============================================================

Basic Controller

namespace App\Http\Controllers; //?namespace of controller

use App\Models\User; //Model
use Illuminate\Http\Request;
 
class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(string $id): View
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
}


{Once you have written a controller class and method,
you may define a route to the controller method like so}


 use App\Http\Controllers\UserController;
 
Route::get('/user/{id}', [UserController::class, 'show']);



============================================================

single Action Controllers ?
 
namespace App\Http\Controllers;
class ProvisionServer extends Controller
{
    /**
     * Provision a new web server.
     */
    public function __invoke() 
    {
        // ...
    }
}

//* Create controller --invokable
//? php artisan make:controller ProvisionServer --invokable

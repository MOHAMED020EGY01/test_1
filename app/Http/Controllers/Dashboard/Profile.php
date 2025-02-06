<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile as ModelProfile;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
class Profile extends Controller
{
    public function edit(){
        $userProfile = Auth::user();
        $countryes = Countries::getNames();
        return view("Dashboard.admin.profile",compact("userProfile","countryes"));
    }
    public function update(Request $request){
        $request->validate([
            'frist_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // 'birthday' => 'required|date|before:today',
            'gender'=>'required|in:male,female',
            'country'=>'required|string|size:2',
        ]);
        $userProfile = Auth::user();
        $userProfile->profile->fill($request->all())->save();
        return redirect()->route('profile')->with('success','Profile Updated Successfully');

    }
}

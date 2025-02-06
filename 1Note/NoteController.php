<?php
/*
class DashboardController extends Controller
{

    //! علشان استخدم كل فاكشن تحت ميدل وير 
----------------------------------------------------------
    public function __construct(){
      //*  $this->middleware('auth');
    }
    //! ممكن نعمل حاجه تنية 

    //* $this->middleware('auth')->except(['index']); //index يطبق علي جميع عدا 
    
    //* $this->middleware('auth')->only(['index']); //index يطبق عليه فقط

-----------------------------------------------------------


    public function index(){
         $user = Auth::user();

         dd($user);

        return view("dashboard");
    }


    

}
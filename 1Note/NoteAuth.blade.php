
//! علشان اجيب اسم او الايميل او اي حاجه مرتبطة بالجدول الخاص بالمستخدم
{{Auth::user()->name}} 

{{Auth::check()}} // ترجع ترو او فولس 

//! تحقق من تسجيل دخول 
@auth

@endauth 

//! لو كان ضيف مس مسجل 
@guest 

@endguest

<input type="hidden" name="_token" value="{{ csrf_token() }}"> //csrf حماية من اختراق 
{{csrf_field()}}
@csrf



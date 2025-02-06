<?php
/*

*category(id (pk),name ,slug , parent_id(fk my self) , slug (uq))


*product (id (pk),status_id(fk) ,category_id(fk) , name , slug (uq), description  , price , state)

*status (id (pk),name , slug , parent_id(fk my self) , slug (uq))




!DONE
* order (id (pk) , user_id(fk) , status_id(fk) , created_at , updated_at)

* order_item (id (pk) , order_id(fk) , product_id(fk) , quantity , price) 


* ده امر علشان يعمل ملف ميرجريشن لازم اسم يكون جمع 
! php artisan make:migration create_names_table 


===========================================================================
!public function up() // يستخدم في عمليات الميرجريشن 
{
                    *اسم الجدول
                                   *الحقول 
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    
}
 
!public function down() // يستخدم في تراجع عن الميجريشن 
{
    
}



!! dd(); // فاكشن للديبج 

*/

?>
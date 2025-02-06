<?php
/*

*category(id (pk),name , parent_id(fk my self) , slug (uq))


*product (id (pk),stores_id(fk) ,category_id(fk) , name , slug (uq), description  , price , state)

*stores (id (pk),name  , parent_id(fk my self),category_id(fk) , slug (uq),state)




!DONE
* order (id (pk) , user_id(fk) , stores_id(fk) , created_at , updated_at)

* order_item (id (pk) , order_id(fk) , product_id(fk) , quantity , price) 


* ده امر علشان يعمل ملف ميرجريشن لازم اسم يكون جمع 
! php artisan make:migration create_names_table 

! php artisan migrate // يبعتها لي داتا بيز
===========================================================================
!public function up() // يستخدم في عمليات الميرجريشن 
{
                    *اسم الجدول
                                   *الحقول 
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            @ id  == BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY

            $table->string('name');
            @ name == VARCHAR(255)

            $table->string('name', 150);
            @ name == VARCHAR(150)

            $table->test('comment');

            @ comment == TEXT(64000)

            $table->timestamps();
            @ timestamps == created_at , updated_at

            $table->string('name')->unique(); // مفيش حد زيه 

            $table->enum('state', ['active', 'inactive' ])->default('active');
            
            $table->foreignId('perent_id')->nullable()->constrained('NameTable')->nullOnDelete();


            @ nullOnDelete // يحذفه من دون البيانات ال فيه 
            
            @ cascadeOnDelete // هيحذف كله 

            @ restrictOnDelete // تمنع عملية الحذف لو  في بيانات مرتبطة بيه 

            @  Defult => restrictOnDelete
            
            });
    

            ENGINE = DB

            MyISAM ,  لازم حقل 191

            InnoDB
}
 
!public function down() // يستخدم في تراجع عن الميجريشن 
{
    Schema::dropIfExists('stores'); // حذف 
}




*/


?>
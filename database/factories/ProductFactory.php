<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name =$this->faker->words(2, true);
        return [
            "name"=> $name,
            "slug"=>Str::slug($name),
            "description"=> $this->faker->sentence(15),
            "quantity"=>$this->faker->numberBetween(1, 100),
            "price"=> $this->faker->randomFloat(1, 1,499),
            'compare_price' => $this->faker->randomFloat(1, 500,999),
            'rating'=> $this->faker->randomElement([1,2,3,4,5]),
            'featured'=>$this->faker->randomElement([0,1]),
            'image' => $this->faker->imageUrl(300,300),    
            'logo' => $this->faker->imageUrl(50,50),
            'video' => $this->faker->imageUrl(600,600),
            'stores_id'=> Store::inRandomOrder()->first()->id,
            'category_id'=> Category::inRandomOrder()->first()->id
        ];
    }
}

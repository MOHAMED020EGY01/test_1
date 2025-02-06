<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
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
            "status"=> $this->faker->randomElement(["Active","Inactive"]),
            "image"=> $this->faker->imageUrl(600,600),
            "logo"=> $this->faker->imageUrl(50,50),
        ];
    }
}

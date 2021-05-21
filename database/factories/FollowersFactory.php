<?php

namespace Database\Factories;

use App\Models\Followers;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Followers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'followed_userid'=>$this->faker->numberBetween(0,11),
            'userid'=>$this->faker->numberBetween(0,11)
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\WorkDays;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkDays>
 */
class WorkDaysFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    protected $model = WorkDays::class;
    
    public function definition()
    {
        return [
            //
        ];
    }
}

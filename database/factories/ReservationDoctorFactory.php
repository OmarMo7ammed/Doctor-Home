<?php

namespace Database\Factories;

use App\Models\ReservationDoctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationDoctor>
 */
class ReservationDoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ReservationDoctor::class;
    public function definition()
    {
        return [
            //
        ];
    }
}

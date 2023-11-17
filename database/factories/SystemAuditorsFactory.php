<?php

namespace Database\Factories;

use App\Models\SystemAuditor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SystemAuditorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = SystemAuditor::class;

    public function definition()
    {
        return [
            //
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => Organization::all()->random()->id,
            'country_id'      => Country::all()->random()->id,
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'email'           => $this->faker->email,
            'phone'           => $this->faker->phoneNumber,
            'address'         => $this->faker->address,
            'city'            => $this->faker->city,
            'state'           => $this->faker->state,
            'zip_code'        => $this->faker->postcode,
        ];
    }
}

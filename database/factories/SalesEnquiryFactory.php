<?php

namespace Database\Factories;

use App\Models\SalesEnquiry;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesEnquiry>
 */
class SalesEnquiryFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = SalesEnquiry::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inquiry_date_received' => $this->faker->date(),
            'item_code' => $this->faker->numberBetween(1000, 9999),
            'author_id' => User::factory(),
            'assigned_sales_person_id' => User::factory(),
            'client_name' => $this->faker->company(),
            'delivery_point' => $this->faker->address(),
            'materials_description' => $this->faker->paragraph(),
            'date_sent_quotation_to_client' => $this->faker->optional()->date(),
            'date_follow_up_to_client' => $this->faker->optional()->date(),
            'quotation_status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
            'lpo_received' => $this->faker->randomElement(['YES', 'NO']),
            'no_of_days_taken_for_preparing_quotation' => $this->faker->numberBetween(1, 30),
            'remark' => $this->faker->sentence(),
            'contact_person' => $this->faker->name(),
            'contact_no' => $this->faker->numerify('##########'),
            'email' => $this->faker->safeEmail(),
            'buying_price' => $this->faker->randomFloat(2, 100, 10000),
            'selling_price' => $this->faker->randomFloat(2, 150, 15000),
            'quotation_no' => $this->faker->unique()->numberBetween(1000, 9999),
            'follow_up' => $this->faker->optional()->sentence(),
            'lpo_received_text' => $this->faker->optional()->sentence(),
        ];
    }
}

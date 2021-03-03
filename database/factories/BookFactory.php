<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $valid_isbn = [
            '0005534186',
            '0978110196',
            '0978108248',
            '0978194527',
            '0978194004',
            '0978194985',
            '0978171349',
            '0978039912',
            '0978031644',
            '0978168968',
            '0978179633',
            '0978006232',
            '0978195248',
            '0978125029',
            '0978078691',
            '0978152476',
            '0978153871',
            '0978125010',
            '0593139135',
            '0441013597'
        ];
        return [
            'title' => $this->faker->title,
            'isbn' => $this->faker->randomElement($valid_isbn),
            'published_at' => $this->faker->date(),
            'status' => $this->faker->randomElement(Book::STATUS)
        ];
    }
}

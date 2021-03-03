<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        $books = Book::factory(20)->make();

        foreach ($books as $book) {
            repeat:
            try {
                $book->save();

                if ($book->status === Book::STATUS['CHECKED_OUT']) {
                    DB::table('user_action_logs')->insert([
                        'book_id' => $book->id,
                        'user_id' => (new User)->inRandomOrder()->first()->id,
                        'action' => 'CHECKOUT',
                    ]);
                }
            } catch (QueryException $e) {
                $book = Book::factory()->make();
                goto repeat;
            }
        }
    }
}

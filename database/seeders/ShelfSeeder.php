<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shelvesData = $this->getShelves();

        $user = $this->getUser();

        foreach ($shelvesData as $shelf) {
            $shelf['user_id'] = $user->id;
            $model = \App\Models\Shelf::factory()->create($shelf);
            $model->books()->attach(Book::all()->random(4)->pluck('id'));
        }


    }

    /**
     * Get the user to seed.
     *
     * @return User The user to seed.
     */
    private function getUser(): User
    {
        return User::firstOr(function () {
            return User::factory()->create();
        });
    }

    /**
     * Get the shelves to seed.
     *
     * @return array The shelves to seed.
     */
    private function getShelves(): array
    {
        return [
            [
                'name' => 'Fiction',
                'description' => 'Books that are not based on real events.',
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Books that are based on real events.',
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Books that are based on futuristic science and technology.',
            ],
        ];
    }
}

<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Shelf;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * This class tests the shelf controller.
 *
 * @package Tests\Feature
 */
class ShelfControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test adding a book to a shelf.
     *
     * @return void
     */
    public function test_add_book_to_shelf(): void
    {
        $user = User::factory()->create();
        $shelf = Shelf::factory()->create(['user_id' => $user->id]);
        $book = Book::factory()->create();

        $response = $this->ActingAs($user)
            ->post("/api/shelves/{$shelf->id}/book/{$book->id}");

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson(function (AssertableJson $json) {
                $json->where('success', true)
                    ->where('message', trans('api.shelf_book.added'))
                ->etc();
            });

        $this->assertDatabaseHas('book_shelf', [
            'shelf_id' => $shelf->id,
            'book_id' => $book->id
        ]);
    }

    /**
     * Test removing a book from a shelf.
     *
     * @return void
     */
    public function test_remove_book_from_shelf(): void
    {
        $user = User::factory()->create();
        $shelf = Shelf::factory()->create(['user_id' => $user->id]);
        $book = Book::factory()->create();

        $shelf->books()->attach($book);

        $response = $this->ActingAs($user)
            ->delete("/api/shelves/{$shelf->id}/book/{$book->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(function (AssertableJson $json) {
                $json->where('success', true)
                    ->where('message', trans('api.shelf_book.removed'))
                    ->etc();
            });

        $this->assertDatabaseMissing('book_shelf', [
            'shelf_id' => $shelf->id,
            'book_id' => $book->id
        ]);
    }

    /**
     * Test adding a book that already exists in a shelf.
     *
     * @return void
     */
    public function test_add_existing_book_to_shelf(): void
    {
        $user = User::factory()->create();
        $shelf = Shelf::factory()->create(['user_id' => $user->id]);
        $book = Book::factory()->create();

        $shelf->books()->attach($book);

        $response = $this->ActingAs($user)
            ->post("/api/shelves/{$shelf->id}/book/{$book->id}");

        $response->assertStatus(Response::HTTP_CONFLICT)
            ->assertJson(function (AssertableJson $json) {
                $json->where('success', false)
                    ->where('message', trans('api.shelf_book.exists'))
                    ->etc();
            });

        $this->assertDatabaseHas('book_shelf', [
            'shelf_id' => $shelf->id,
            'book_id' => $book->id
        ]);
    }

    /**
     * Test removing a book that does not exist in a shelf.
     *
     * @return void
     */
    public function test_remove_non_existing_book_from_shelf(): void
    {
        $user = User::factory()->create();
        $shelf = Shelf::factory()->create(['user_id' => $user->id]);
        $book = Book::factory()->create();

        $response = $this->ActingAs($user)
            ->delete("/api/shelves/{$shelf->id}/book/{$book->id}");

        $response->assertStatus(Response::HTTP_CONFLICT)
            ->assertJson(function (AssertableJson $json) {
                $json->where('success', false)
                    ->where('message', trans('api.shelf_book.not_found'))
                    ->etc();
            });

        $this->assertDatabaseMissing('book_shelf', [
            'shelf_id' => $shelf->id,
            'book_id' => $book->id
        ]);
    }
}

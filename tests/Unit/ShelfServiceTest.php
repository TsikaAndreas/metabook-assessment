<?php

namespace Tests\Unit;

use App\Http\Requests\ShelfRequest;
use App\Models\Book;
use App\Models\Shelf;
use App\Models\User;
use App\Services\ShelfService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ShelfServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the create method of the ShelfService.
     *
     * @return void
     */
    public function test_create_method_creates_shelf(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $validatedData = [
            'name' => 'Test Shelf',
            'description' => 'A description of the test shelf.',
        ];

        $request = Mockery::mock(ShelfRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $shelfService = new ShelfService();
        $shelfResource = $shelfService->create($request);

        $this->assertDatabaseHas('shelves', [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'user_id' => $user->id,
        ]);

        $this->assertEquals($validatedData['name'], $shelfResource->name);
        $this->assertEquals($validatedData['description'], $shelfResource->description);
    }

    /**
     * Test the removeBook method of the ShelfService.
     *
     * @return void
     */
    public function test_remove_book_from_shelf(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $shelf = Shelf::factory()->create(['user_id' => $user->id]);
        $book = Book::factory()->create();
        $shelf->books()->attach($book);

        $shelfService = new ShelfService();

        $response = $shelfService->removeBook($shelf->id, $book->id);

        $this->assertTrue($response->getData()->success);
        $this->assertEquals(trans('api.shelf_book.removed'), $response->getData()->message);
        $this->assertDatabaseMissing('book_shelf', [
            'shelf_id' => $shelf->id,
            'book_id' => $book->id,
        ]);
    }

    /**
     * Test the removeBook method when the book is not found on the shelf.
     *
     * @return void
     */
    public function test_remove_book_not_found_on_shelf(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $shelf = Shelf::factory()->create(['user_id' => $user->id]);
        $book = Book::factory()->create();

        $shelfService = new ShelfService();

        $response = $shelfService->removeBook($shelf->id, $book->id);

        $this->assertFalse($response->getData()->success);
        $this->assertEquals(trans('api.shelf_book.not_found'), $response->getData()->message);
    }
}

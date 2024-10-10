<?php

namespace App\Services;
use App\Http\Requests\ShelfRequest;
use App\Http\Resources\ShelfResource;
use App\Models\Book;
use App\Models\Shelf;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * This class handles the shelf operations.
 *
 * @package App\Services
 */
class ShelfService {

    use HttpResponses;

    /**
     * Create a new shelf and return the resource.
     *
     * @return ShelfResource
     */
    public function create(ShelfRequest $request): ShelfResource
    {
        $object = $request->validated();
        $object['user_id'] = auth()->id();
        $shelf = Shelf::create($object);

        return new ShelfResource($shelf);
    }

    /**
     * Update a shelf and return the resource.
     *
     * @param string $id
     * @return ShelfResource
     */
    public function update(ShelfRequest $request, string $id): ShelfResource
    {
        $object = Shelf::findOrFail($id);
        $object->update($request->validated());

        return new ShelfResource($object);
    }

    /**
     * Add a book to a shelf.
     *
     * @param string $shelfId
     * @param string $bookId
     * @return JsonResponse
     */
    public function addBook(string $shelfId, string $bookId): JsonResponse
    {
        $shelf = Shelf::findOrFail($shelfId);
        $book = Book::findOrFail($bookId);

        if ($shelf->books()->where('book_id', $book->id)->exists()) {
            return (new self)->errorResponse(null, trans('api.shelf_book.exists'), Response::HTTP_CONFLICT);
        }

        $shelf->books()->attach($book);
        return (new self)->successResponse(null, trans('api.shelf_book.added'), Response::HTTP_CREATED);
    }

    /**
     * Remove a book from a shelf.
     *
     * @param string $shelfId
     * @param string $bookId
     * @return JsonResponse
     */
    public function removeBook(string $shelfId, string $bookId): JsonResponse
    {
        $shelf = Shelf::findOrFail($shelfId);
        $book = Book::findOrFail($bookId);

        if (!$shelf->books()->where('book_id', $book->id)->exists()) {
            return (new self)->errorResponse(null, trans('api.shelf_book.not_found'), Response::HTTP_CONFLICT);
        }

        $shelf->books()->detach($book);
        return (new self)->successResponse(null, trans('api.shelf_book.removed'), Response::HTTP_OK);
    }
}

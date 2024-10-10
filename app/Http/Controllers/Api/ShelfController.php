<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShelfRequest;
use App\Http\Resources\ShelfResource;
use App\Models\Shelf;
use App\Services\ShelfService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * This class handles the shelf resources.
 *
 * @package App\Http\Controllers
 */
class ShelfController extends Controller
{
    use HttpResponses;

    /**
     * The shelf service instance.
     *
     * @var ShelfService
     */
    protected ShelfService $shelfService;

    /**s
     * ShelfController constructor.
     *
     * @param ShelfService $shelfService
     */
    public function __construct(ShelfService $shelfService)
    {
        $this->shelfService = $shelfService;
    }

    /**
     * Display a listing of the resources paginated.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = ShelfResource::collection(Shelf::paginate(3))->response()->getData(true);
        return $this->successResponse($data);
    }

    /**
     * Store a newly created resource in the database.
     */
    public function store(ShelfRequest $request): JsonResponse
    {
        $shelf = $this->shelfService->create($request);
        return $this->successResponse($shelf, trans('api.shelf.created'),Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $shelf = Shelf::with('books')->findOrFail($id);
        $data = new ShelfResource($shelf);
        return $this->successResponse($data);
    }

    /**
     * Update the specified resource in the database.
     */
    public function update(ShelfRequest $request, string $id): JsonResponse
    {
        $data = $this->shelfService->update($request, $id);
        return $this->successResponse($data, trans('api.shelf.updated'));
    }

    /**
     * Remove the specified resource from the database.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $object = Shelf::findOrFail($id);
        $object->delete($id);
        return $this->successResponse(null, trans('api.shelf.deleted'));
    }

    /**
     * Add a book to the shelf.
     *
     * @param string $shelfId
     * @param string $bookId
     * @return JsonResponse
     */
    public function addBook(string $shelfId, string $bookId): JsonResponse
    {
        return $this->shelfService->addBook($shelfId, $bookId);
    }

    /**
     * Remove a book from the shelf.
     *
     * @param string $shelfId
     * @param string $bookId
     * @return JsonResponse
     */
    public function removeBook(string $shelfId, string $bookId): JsonResponse
    {
        return $this->shelfService->removeBook($shelfId, $bookId);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

/**
 * This class handles the book resources.
 *
 * @package App\Http\Controllers
 */
class BookController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resources paginated.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = BookResource::collection(Book::paginate(9))->response()->getData(true);
        return $this->successResponse($data);
    }
}

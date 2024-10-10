<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HttpResponses
{
    /**
     * Return an error response.
     *
     * @param $payload
     * @param int $statusCode
     * @param string|null $message
     * @return JsonResponse
     */
    public function errorResponse($payload, string $message = null, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'payload' => $payload,
        ], $statusCode);
    }

    /**
     * Return a success response.
     *
     * @param $payload
     * @param int $statusCode
     * @param string|null $message
     * @return JsonResponse
     */
    public function successResponse($payload = null, string $message = null, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'payload' => $payload,
        ], $statusCode);
    }
}

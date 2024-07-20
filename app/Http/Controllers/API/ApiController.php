<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(title: "Trakli API", version: "1.0.0")]
#[OA\Server(url: "http://localhost:8000/api/v1", description: "Development server")]
#[OA\Server(url: "https://api.trakli.io/v1", description: "Production server")]
#[OA\Server(
    url: "{protocol}://{host}/api/v1",
    description: "Dynamic server URL",
    // TODO : Figure this out it causes an error
    // variables: [
    //     new OA\ServerVariable(name: "protocol", default: "https", enum: ["http", "https"]),
    //     new OA\ServerVariable(name: "host", default: "api.trakli.io", enum: ["api.trakli.io", "api.staging.example.com"])
    // ]
)]
class ApiController extends BaseController
{
    /**
     * Return a success response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function success($data = null, string $message = 'Operation successful', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $statusCode);
    }

    /**
     * Return a failure response.
     *
     * @param string $message
     * @param int $statusCode
     * @param array $errors
     * @return JsonResponse
     */
    protected function failure(string $message = 'Operation failed', int $statusCode = 400, array $errors = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
        ], $statusCode);
    }
}

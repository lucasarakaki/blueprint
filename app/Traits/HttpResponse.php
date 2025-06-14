<?php

namespace App\Traits;

use Illuminate\Contracts\Support\MessageBag;

trait HttpResponse
{
    /**
     * Generate a successful JSON response.
     *
     * @param  string         $message
     * @param  int            $status
     * @param  array          $data
     * @return JsonResponse
     */
    public function success( string $message, int $status, array $data = [] )
    {
        return response()->json( [
            'message' => $message,
            'status'  => $status,
            'data'    => $data,
        ], $status );
    }

    /**
     * Generate an error JSON response.
     *
     * @param  string         $message
     * @param  int            $status
     * @param  array          $errors
     * @param  array          $data
     * @return JsonResponse
     */
    public function error( string $message, int $status, array | MessageBag $errors = [], array $data = [] )
    {
        return response()->json( [
            'message' => $message,
            'status'  => $status,
            'errors'  => $errors,
            'data'    => $data,
        ], $status );
    }
}

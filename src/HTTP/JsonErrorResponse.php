<?php

namespace App\HTTP;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonErrorResponse extends JsonResponse
{
    public function __construct(string $errorMessage, int $status)
    {
        $data['result'] = 'error';
        $data['status_code'] = $status;
        $data['error_message'] = $errorMessage;
        parent::__construct($data, $status);
    }
}
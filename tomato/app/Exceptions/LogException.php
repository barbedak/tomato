<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LogException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report(): void
    {
//        echo $this->message.PHP_EOL;
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): Response
    {
//        return response([
//            'message' => $this->message
//        ], $this->code);
    }

    public static function startLogging(string $message){
        throw new self($message);
    }

    public static function endLogging(string $message){
        throw new self($message);
    }
}

<?php

namespace App\Exceptions;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;

class PostException extends Exception
{
    public function __construct(private Post $post, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report(): void
    {
        Log::channel('posts')->info($this->message . ' with id {id}', ['id' => $this->post->id]);
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response([
            'message' => $this->message
        ], $this->code);
    }

    public static function isAlreadyExists(Post $post)
    {

        if (!$post->wasRecentlyCreated) {
            throw new PostException($post,'Post created', Response::HTTP_UNPROCESSABLE_ENTITY); //вызовет рендер
        }
    }
}

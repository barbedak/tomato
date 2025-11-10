<?php

namespace App\HttpClients;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PostHttpClient
//????? class TomatoPostHttpClient
{

    private string $token = '';
    private int $tokenExpiredAt = 0;
    private string $domain = '';

    public static function make(): self
    {
        $self = new self();
        $self->domain = config('tomato.domain');
        return $self;
    }

    public function indexPosts(): Response
    {
        return Http::withToken($this->token)->get($this->domain . '/api/posts');
    }

    /**
     * @throws Exception
     */
    public function login(): self
    {
        if ($this->isTokenNotValid()) {
            $this->setToken();
        }
        return $this;
    }

    private function setToken(): void
    {
        $loginPath = config('tomato.login_path');

        $res = Http::post($this->domain . $loginPath, [
            'email' => config('tomato.email'),
            'password' => config('tomato.password')
        ]);
        if (!array_key_exists('error',$res->json())){
//        if ($res->getStatusCode() == 200) {
            $this->tokenExpiredAt = time() + $res->json()['expires_in'];
            $this->token = $res->json()['access_token'];
        } else {
            $message = 'Login response error ' . $res->getStatusCode() . ' ' . $res->json()['error'] . PHP_EOL;
            echo($message);
//            alternative echo()
//            throw new Exception($message);
        }
    }

    private function isTokenNotValid(): bool
    {
        return $this->isTokenExpired() or $this->isTokenNotSet();
    }

    private function isTokenExpired(): bool
    {
        return time() >= $this->tokenExpiredAt;
    }

    private function isTokenNotSet(): bool
    {
        return $this->token == '';
    }
}

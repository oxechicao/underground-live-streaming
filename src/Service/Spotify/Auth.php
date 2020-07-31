<?php


namespace App\Service\Spotify;


use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Auth extends Base
{
    public $scope = 'user-read-currently-playing';
    public $url = 'https://accounts.spotify.com/authorize?';

    public function getRouteRedirect($redirectUrl, $state)
    {
        return $this->url . http_build_query([
                'response_type' => 'code',
                'client_id' => $_ENV['CLIENT_ID'],
                'scope' => $this->scope,
                'redirect_uri' => $redirectUrl,
                'state' => $state,
            ]);
    }

    public function requestToken(array $body)
    {
        $url = 'https://accounts.spotify.com/api/token';
        $headers = [
            'Authorization' => 'Basic ' . $this->basicBuffer,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $response = $this->client->request(
            'POST',
            $url,
            [
                'headers' => $headers,
                'body' => $body
            ]
        );

        try {
            $content = $response->toArray();
        } catch (ClientExceptionInterface $e) {
            dump('client', $e);
            die;
        } catch (RedirectionExceptionInterface $e) {
            dump('redirection', $e);
            die;
        } catch (ServerExceptionInterface $e) {
            dump('server', $e);
            die;
        } catch (TransportExceptionInterface $e) {
            dump('transport', $e);
            die;
        }
        return $content;
    }

    public function getToken(string $code, string $redirectUrl)
    {
        return $this->requestToken([
            'code' => $code,
            'redirect_uri' => $redirectUrl,
            'grant_type' => 'authorization_code',
        ]);
    }

    public function refreshToken(string $refreshToken)
    {
        return $this->requestToken([
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
        ]);
    }

}
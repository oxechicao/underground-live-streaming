<?php

namespace App\Service\Spotify;


class Playlist extends Base
{
    public $url = 'https://api.spotify.com/v1/playlists/6VGRKNjJCjxGm3xKob5ef5/tracks?offset=';

    public function getDataPlaylist($token, int $offset = 0, array $items = [])
    {
        $response = $this->client->request(
            'GET',
            $this->url . $offset,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]
        );

        $content = $response->toArray();
        $items = array_merge($items, $content['items']);
        if (($content['total'] - (100 + $offset)) > 0) {
            return $this->getDataPlaylist($token, ($offset + 100), $items);
        }

        return array_map(function ($item) {
            return $item['track']['artists'];
        }, $items);
    }

    public function getArtistsAndUrls(): array
    {
        $token = (new Auth())->refreshToken($_ENV['REFRESH_TOKEN']);
        $playlist = $this->getDataPlaylist($token['access_token']);
        shuffle($playlist);
        $data = [];
        foreach ($playlist as $artists) {
            foreach ($artists as $artist) {
                if (!array_key_exists($artist['id'], $data)) {
                    $data[$artist['id']] = [
                        'name' => $artist['name'],
                        'url' => $artist['external_urls']['spotify'],
                    ];
                }
            }
        }

        return $data;
    }
}
<?php


namespace App\Service\Spotify;


class CurrentSong extends Base
{
    public $url = 'https://api.spotify.com/v1/me/player/currently-playing';

    public function getCurrentSong($token, $size)
    {
        $resposne = $this->client->request(
            'GET',
            $this->url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]
        );

        $data = $resposne->toArray();
        $artists = implode(', ', array_map(function ($item) {
            return $item['name'];
        }, $data['item']['artists']));

        return [
            'albumImage' => $data['item']['album']['images'][1]['url'],
            'songName' => $data['item']['name'],
            'sizeBannerBg' => ceil(
                (((strlen($data['item']['name']) + strlen($artists)) / 2) * (
                    strlen($data['item']['name']) > strlen($artists)
                        ? (strlen($data['item']['name']) / strlen($artists))
                        : strlen($artists) / strlen($data['item']['name'])
                )) + $size
            ),
            'artists' => $artists,
        ];

    }
}
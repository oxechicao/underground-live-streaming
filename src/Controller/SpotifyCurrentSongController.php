<?php

namespace App\Controller;

use App\Service\Spotify\Auth;
use App\Service\Spotify\CurrentSong;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpotifyCurrentSongController extends AbstractController
{
    /**
     * @Route("/spotify/current-song/{refresh}/{size}", name="spotify.current.song")
     * @param string $refresh
     * @param CurrentSong $currentSong
     * @param Auth $auth
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     */
    public function currentSong(string $refresh, int $size, CurrentSong $currentSong, Auth $auth)
    {
        return $this->json(
            $currentSong->getCurrentSong(
                $auth->refreshToken($refresh)['access_token'],
                $size,
            )
        );
    }
}

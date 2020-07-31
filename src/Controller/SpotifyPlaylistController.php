<?php

namespace App\Controller;

use App\Service\Spotify\Playlist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpotifyPlaylistController extends AbstractController
{

    /**
     * @Route("/spotify/playlist", name="spotify_playlist")
     */
    public function index(Playlist $playlist)
    {
        return $this->json($playlist->getArtistsAndUrls());
    }
}

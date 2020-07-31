<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpotifyAlbumMusicArtistBannerController extends AbstractController
{
    /**
     * @Route("/spotify/ama/l/{token}/{refresh}", name="spotify.ama.l")
     */
    public function albumMusicArtistLeft(string $token, string $refresh)
    {
        return $this->render('spotify_full_banner/index.html.twig', [
            'token' => $token,
            'refresh' => $refresh,
            'float' => 'left'
        ]);
    }

    /**
     * @Route("/spotify/ama/r/{token}/{refresh}", name="spotify.ama.r")
     */
    public function albumMusicArtistRight(string $token, string $refresh)
    {
        return $this->render('spotify_full_banner/index.html.twig', [
            'token' => $token,
            'refresh' => $refresh,
            'float' => 'right'
        ]);
    }
}
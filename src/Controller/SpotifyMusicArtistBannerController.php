<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpotifyMusicArtistBannerController extends AbstractController
{
    /**
     * @Route("/spotify/ma/l/{token}/{refresh}", name="spotify.ma.l")
     */
    public function musicArtistLeft(string $token, string $refresh)
    {
        return $this->render('spotify_music_artist_banner/index.html.twig', [
            'token' => $token,
            'refresh' => $refresh,
            'float' => 'left',
            'baseURL' => $_ENV['SITE_URL']
        ]);
    }

    /**
     * @Route("/spotify/ma/r/{token}/{refresh}", name="spotify.ma.r")
     */
    public function musicArtistRight(string $token, string $refresh)
    {
        return $this->render('spotify_music_artist_banner/index.html.twig', [
            'token' => $token,
            'refresh' => $refresh,
            'float' => 'right',
            'baseURL' => $_ENV['SITE_URL']
        ]);
    }
}

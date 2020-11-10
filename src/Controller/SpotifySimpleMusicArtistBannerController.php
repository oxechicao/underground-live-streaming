<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpotifySimpleMusicArtistBannerController extends AbstractController
{
    /**
     * @Route("/spotify/sma/{color}/{fontSize}/{justify}/{refresh}", name="spotify.sma")
     */
    public function musicArtistLeft(string $color, string $fontSize, string $justify, string $refresh)
    {
        return $this->render('spotify_simple_music_artist_banner/index.html.twig', [
            'color' => $color,
            'refresh' => $refresh,
            'fontSize' => $fontSize,
            'justify' => $justify,
            'baseURL' => $_ENV['SITE_URL']
        ]);
    }

    /**
     * @Route("/spotify/sma/r/{token}/{refresh}", name="spotify.sma.r")
     */
    public function musicArtistRight(string $token, string $refresh)
    {
        return $this->render('spotify_simple_music_artist_banner/index.html.twig', [
            'token' => $token,
            'refresh' => $refresh,
            'float' => 'right',
            'baseURL' => $_ENV['SITE_URL']
        ]);
    }
}

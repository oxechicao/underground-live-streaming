<?php


namespace App\Controller;

use App\Service\Spotify\Auth;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;


class SpotifyLogin extends AbstractController
{
    /**
     * @Route("/spotify/login", name="spotify.login")
     */
    public function login(Auth $auth, SessionInterface $session)
    {
        $state = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(32))), 0, 16);
        $session->set('state_login', $state);
        $redirectUri = $_ENV['APP_ENV'] !== 'prod'
            ? $this->generateUrl('spotify.callback', [], UrlGenerator::ABSOLUTE_URL)
            : str_replace('http:', 'https:', $this->generateUrl('spotify.callback', [], UrlGenerator::ABSOLUTE_URL));

        return $this->redirect(
            $auth->getRouteRedirect(
                $redirectUri,
                $state
            )
        );
    }

    /**
     * @Route("/spotify/callback", name="spotify.callback")
     */
    public function callback(Request $request, Auth $auth, SessionInterface $session)
    {
        if ($session->get('state_login') !== $request->query->get('state')) {
            die('login failed');
        }

        $redirectUri = $_ENV['APP_ENV'] !== 'prod'
            ? $this->generateUrl('spotify.callback', [], UrlGenerator::ABSOLUTE_URL)
            : str_replace('http:', 'https:', $this->generateUrl('spotify.callback', [], UrlGenerator::ABSOLUTE_URL));

        $session->remove('state_login');
        $data = $auth->getToken(
            $request->query->get('code'),
            $redirectUri
        );

        $session->set('refresh', $data['refresh_token']);
        $session->set('token', $data['access_token']);

        return $this->redirectToRoute('home');
    }
}
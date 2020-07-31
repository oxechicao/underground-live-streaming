<?php
declare(strict_types=1);


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class Home extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SessionInterface $session)
    {
        return $this->render('home.html.twig');
    }

}
<?php
declare(strict_types=1);


namespace App\Controller;

use App\Document\Artists;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Home extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DocumentManager $dm)
    {
        return $this->render(
            'home.html.twig',
            ['baseURL' => $_ENV['SITE_URL']]
        );
    }

}
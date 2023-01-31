<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    #[Route('/home',name: 'main_home')]
        public function home():Response
    {
        return $this->render( 'main/home.html.twig');

    }

    #[Route('/about_us', name: 'main_about_us')]
    public function about_us(): Response
    {
        $file='../Data/team.json';
        $data=file_get_contents($file);
        $team=json_decode($data, true);
        dump($team);

        return $this->render('main/about_us.html.twig', ['team'=>$team]);
    }

}
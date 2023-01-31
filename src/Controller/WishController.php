<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    #[Route('/list', name: 'wish_list')]
    public function index(): Response
    {
        return $this->render('wish/list.html.twig');
    }


    #[Route('/detail', name: 'wish_detail')]
    public function detail(): Response
    {
        return $this->render('wish/detail.html.twig');
    }
}

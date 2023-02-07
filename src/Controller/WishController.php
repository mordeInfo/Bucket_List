<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\AjoutType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    #[Route('/list', name: 'wish_list')]
    public function liste(

        WishRepository $wishRepository
    ): Response
    {
        $souhaits = $wishRepository->findAll();
        return $this->render('wish/list.html.twig',
            compact('souhaits')
        );
    }


    #[Route('/detail{id}', name: 'wish_detail')]
    public function detail(
        int            $id,
        WishRepository $wishRepository
    ): Response
    {
        $souhait = $wishRepository->findOneBy(['id' => $id]);
        return $this->render('wish/detail.html.twig',
            compact('souhait')
        );
    }

    #[Route('/ajout', name: 'wish_ajout')]
    public function ajout(
        EntityManagerInterface $em,
        Request                $request
    ): Response
    {
        $souhait = new Wish();


        $wishForm = $this->createForm(AjoutType::class, $souhait);
        $wishForm->handleRequest($request);

        if ($wishForm->isSubmitted()) {

            try {
                $souhait->setIsPublished(true);
                $souhait->setDateCreated(new \DateTime('now'));
                if ($wishForm->isValid()) {
                    $em->persist($souhait);
                }
            } catch (\Exception $exception) {
                dd($exception->getMessage());
            }
            $em->flush();
            $this->addFlash('success', 'souhait ajouté');
            return $this->redirectToRoute('wish_detail', ["id" => $souhait->getId()]);
        }
        return $this->render(
            'wish/ajout.html.twig',
            compact('wishForm')
        );
    }
}

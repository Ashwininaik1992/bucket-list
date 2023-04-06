<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
Use Doctrine\ORM\EntityManagerInterface;


class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="app_wish_list")
     */
    public function list(WishRepository $wishRepository): Response
    {
       // $wishes = $wishRepository->findBy(['isPublished'=>true],['dateCreated'=>'DESC']);
        $wishes = $wishRepository->findPublishedWishesWithCategories();

        return $this->render('wish/list.html.twig', [

            "wishes" => $wishes
        ]);
    }

    /**
     * @Route("/wish/details/{id}", name="app_wish_details")
     */
    public function details(int $id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        if (!$wish)
        { throw $this->createNotFoundException('This wish do not exists! Sorry!');
        }
        return $this->render('wish/details.html.twig', [
            "wish" => $wish
        ]);
    }

    /**
     * @Route("/wish/create", name="app_wish_create")
     */

    public function create(Request $request,
        EntityManagerInterface $entityManager
    ): Response

    {
        $wish = new Wish();
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime() );
        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        if ( $wishForm->isSubmitted()){

            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Idea successfully added!');
            return $this->redirectToRoute('app_wish_details', ['id'=>$wish->getId()]);
        }


        return $this->render('wish/create.html.twig', [
            'wishForm' => $wishForm->createView()
        ]);
    }


}
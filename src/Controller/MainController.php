<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main_home")
     */
public function home()
{
    return $this->render('main/home.html.twig');
    //something
}

    /**
     * @Route("/contact", name="app_main_contact")
     */
    public function contact(){
        return $this->render('main/contact.html.twig');
    }

    /**
     * @Route("/aboutus", name="app_main_aboutus")
     */
    public function aboutus()
    {
        return $this->render('main/aboutus.html.twig');

    }



}



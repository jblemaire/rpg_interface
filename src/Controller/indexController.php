<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class indexController extends AbstractController
{
    /**
 * @Route("/", name="homepage")
 */
    public function homepage()
    {


        return $this->render(
            'homepage/homepage.html.twig'
        );
    }
    /**
     * @Route("/recherche", name="recherche")
     */
    public function recherche()
    {
        return $this->render(
            'recherche/recherche.html.twig'
        );
    }
    /**
     * @Route("/navigation", name="navigation")
     */
    public function navigation()
    {
       // dump(php_ini_loaded_file (  ));die;
        return $this->render(
            'navigation.html.twig'
        );
    }

}
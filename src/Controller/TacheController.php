<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TacheController extends AbstractController{

    /**
     * 
     *@Route("/tache",name ="home")
     * 
     */
    public function index()
    {
        return $this->render("Taches/home.html.twig", array());
    }

    /**
     * 
     *@Route("/tache/sh",name ="tache.show")
     * 
     */
    public function show()
    {
        //$tache = $this->repository->find($id);
        return $this->render("Taches/show.html.twig", array());
    }
    
    
}
?>
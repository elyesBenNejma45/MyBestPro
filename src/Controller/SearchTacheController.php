<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheSearchType;
use App\Repository\TacheRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SearchTacheController extends AbstractController {


    /**
     *@var TacheRepository
     */
    private $repository;

    /**
     *@var ObjectManager
     */
    private $em;

    public function __construct(TacheRepository $repository, ObjectManager $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * 
     *@Route("/tache",name ="rechercher")
     *Return Response
     */
    public function index(Request $request): Response
    {
        $search = new Tache();
        $form = $this->createForm(TacheSearchType::class, $search);
        $form->handleRequest($request);
        $searchTaches = $this->repository->findByStatus($search);
        return $this->render("Taches/home.html.twig", [
            'tachesSearch' => $searchTaches,
            'form' => $form->createView()

        ]);
    }
}
?>
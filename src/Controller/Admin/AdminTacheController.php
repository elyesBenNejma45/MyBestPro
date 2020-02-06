<?php

namespace App\Controller\Admin;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\TacheRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminTacheController extends AbstractController{

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
     *@Route("/",name ="admin.tache.index")
     * 
     */
    public function index()
    {
        $taches = $this->repository->findAll();
        return $this->render("Taches/index.html.twig", compact("taches"));
    }

    /**
     * 
     *@Route("/tache/new",name ="admin.tache.new")
     * 
     */
    public function new(Request $request)
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $this->em->persist($tache);
            $this->em->flush();
            $this->addFlash("success", "Bien ajoutée avec succes ");
            return $this->redirectToRoute("admin.tache.index");
        }
        return $this->render("Taches/new.html.twig", [
            "tache" => $tache,
            "form" => $form->createView()
        ]);
    }

    /**
     * 
     *@Route("/tache/{id}",name ="admin.tache.edit", methods = "GET|POST") 
     *@param Tache $tache
     *@param Request $request
     *return Symfony\Component\HttpFoundation\Response
     */
    public function edit(Tache $tache,Request $request)
    {
        $date = new DateTime();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        $tache->setDateMiseAjour($date::createFromFormat('Y-m-d',date("Y-m-d")));
        if($form->isSubmitted()&& $form->isValid()){
            $this->em->flush();
            $this->addFlash("success", "Bien modifiée avec succes ");
            return $this->redirectToRoute("admin.tache.index");
        }
        return $this->render("Taches/edit.html.twig", [
            "tache" => $tache,
            "form" => $form->createView()
        ]);
    }

     /**
     *@Route("/tache/{id}",name ="admin.tache.delete",  methods = "DELETE")
     *@param Tache $tache
     * 
     */
    public function delete(Tache $tache,Request $request)
    {
            $this->em->remove($tache);
            $this->em->flush();
            $this->addFlash("success", "Bien supprimée avec succes ");
            return $this->redirectToRoute("admin.tache.index");

    }
}
?>
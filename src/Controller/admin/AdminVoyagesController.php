<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;

use App\Entity\Visite;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminVoyagesController
 *
 * @author joann
 */
class AdminVoyagesController extends AbstractController {
    //put your code here
    
    /**
     * @Route("/admin", name="admin.voyages")
     * @return Response
     */
    public function index(): Response {
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("admin/admin.voyages.html.twig", [ 'visites' => $visites]);
    }
   
    /**
     * 
     * @var VisiteRepository
     */
    private $repository;
   
    public function __construct(VisiteRepository $repository) {
       $this->repository = $repository;
    }
    
    /**
     * @Route("/admin/suppr/{id}", name="admin.voyage.suppr")
     * @param int $id
     * @return Response
     */
    public function suppr (int $id) : Response {
        $visite = $this->repository->find($id);
        $this->repository->remove($visite, true);
        return $this->redirectToRoute('admin.voyages');
    }
}

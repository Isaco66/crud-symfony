<?php

namespace App\Controller;

use App\Entity\Crud;
use App\Form\CrudType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/main", name="app_main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("create", name="create")
     */
    public function create(Request $request){
        $crud= new Crud();
        $form = $this->createForm(CrudType::class, $crud);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($crud);
            $this->entityManager->flush();
            return $this->addFlash('success','Datos insertados de manera correcta')
        }
        return $this->render('main/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}

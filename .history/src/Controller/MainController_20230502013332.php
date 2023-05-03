<?php

namespace App\Controller;

use App\Entity\Crud;
use App\Form\CrudType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $entityManager;
    private $managerRegistry;

    public function __construct(EntityManagerInterface $entityManager, ManagerRegistry $managerRegistry)
    {
        $this->entityManager = $entityManager;
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @Route("/main", name="app_main")
     */
    public function index(): Response
    {
        $data=$this->managerRegistry->getRepository(Crud::class)->findAll();
        return $this->render('main/index.html.twig', [
            'listaDatos' => $data
        ]);
    }
    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request){
        $crud= new Crud();
        $form = $this->createForm(CrudType::class, $crud);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($crud);
            $this->entityManager->flush();
            $this->addFlash('success','Datos insertados de manera correcta');
            return $this->redirectToRoute('/main');
        }
        return $this->render('main/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", name="update")
     */
    public function update(Request $request, $id){
        $crud= $this->managerRegistry->getRepository(Crud::class)->find($id);
        $form = $this->createForm(CrudType::class, $crud);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($crud);
            $this->entityManager->flush();
            $this->addFlash('success','Datos actualizados de manera correcta');
            return $this->redirectToRoute('/main');
        }
        return $this->render('main/update.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id){
        $crud= $this->managerRegistry->getRepository(Crud::class)->find($id);
        $this->entityManager->remove($crud);
        $this->entityManager->flush();
            $this->addFlash('success','Datos borrados de manera correcta');
            return $this->redirectToRoute('/main');
    }
}

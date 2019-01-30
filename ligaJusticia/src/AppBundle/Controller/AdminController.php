<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Villano;
use AppBundle\Form\VillanoType;

class AdminController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
   /**
     * @Route("/insertar/", name="insertar")
     */
     public function InsertarAction(Request $request)
    {
      $villano=new Villano();
      $form = $this->createForm(VillanoType::class, $villano);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $villano = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($villano);
        $entityManager->flush();

      }
      return $this->render('insertar.html.twig', array('form' => $form->createView()));
    }

/**
 * @Route("/actualizar/{id}", name="actualizar")
 */
  public function newActionActualizar(Request $request, $id=null)
  {
    if($id)
     {
       $repository = $this->getDoctrine()->getRepository(Villano::class);
       $villano = $repository->find($id);
     }else{
       $villano = new Villano();
     }
     $form = $this->createForm(VillanoType::class,$villano);
        $form->handleRequest($request);
 if ($form->isSubmitted() && $form->isValid()) {

     $villano = $form->getData();
     $em= $this->getDoctrine()->getMAnager();
     $em->persist($villano);
     $em->flush();
 }
      return $this->render('actualizar.html.twig', array(
          'form' => $form->createView(),
      ));
  }


}


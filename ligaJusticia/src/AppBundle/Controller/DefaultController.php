<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Villano;


class DefaultController extends Controller
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
     * @Route("/inicio", name="inicio")
     */
     public function villanosAction(Request $request)
    {
      $repository = $this->getDoctrine()->getRepository(Villano::class);
      $villano = $repository->findAll();
      return $this->render('inicio.html.twig', array('villano' => $villano ));

}

    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction(Request $request)
    {
    $justicia=new Justicia();
      $form = $this->createForm(JusticiaType::class, $justicia);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $justicia = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($justicia);
        $entityManager->flush();

      }
      return $this->render('registro.html.twig', array('form' => $form->createView()));
}
}
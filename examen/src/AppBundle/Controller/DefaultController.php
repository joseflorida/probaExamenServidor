<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuarios;
use AppBundle\Form\UsuariosType;
use AppBundle\Entity\Evento;
use AppBundle\Form\EventoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller
{
    /**
     * @Route("/registrarse", name="registrarse")
     */
    public function registrarseJusticiaAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $usuario = new Usuarios();
        //Construyendo el form.
        $form = $this->createForm(UsuariosType::class,$usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Encriptamos la constraseña
            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
            $usuario->setPassword($password);

            //Recogemos la info del Usuarios
            $usuario = $form->getData();

            // Roles
            $usuario->setRoles(array('ROLE_USER'));

            //Insertamos el form en la BDD.
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();
        }
        //Cargamos esta pagina antes de hacer el sumbit
        return $this->render('registro.html.twig',array('form'=>$form->createView()));

    }

    /**
     * @Route("/", name="login")
     */
    public function entrarAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
         /**
      * @Route("/admin/usuarios/", name="usuarios")
      */

    public function usuariosAction(Request $request)
    {
      $repository = $this->getDoctrine()->getRepository(Usuarios::class);
      $usuarios = $repository->findAll();
      return $this->render('listar_usuarios.html.twig', array('usuarios' => $usuarios ));

}
/**
 * @Route("/admin/evento/insertar_eventos/", name="insertar_eventos")
 */
 public function InsertarAction(Request $request)
{
  $usuario=new Evento();
  $form = $this->createForm(EventoType::class, $usuario);
  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {
    $usuario = $form->getData();
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($usuario);
    $entityManager->flush();

  }
  return $this->render('insertar.html.twig', array('form' => $form->createView()));
}
/**
 * @Route("/evento/listar_eventos/", name="listar_eventos")
 */
public function evento_listaAction(Request $request)
{
  $repository = $this->getDoctrine()->getRepository(Evento::class);
  $usuarios = $repository->findAll();
  return $this->render('listar_eventos.html.twig', array('usuarios' => $usuarios ));

}

}

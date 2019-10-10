<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
  /**
   * @Route("/", name="homepage")
   */
  public function index(Request $request)
  {
    $posts = $this->getDoctrine()->getRepository('App:BlogPost')->findBy(array('draft' => true), array('title' => 'DESC'));

    $contact = new Contact();

    $form = $this->createForm(ContactType::class, $contact);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      try {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();
        $this->get('session')->getFlashBag()->set('success', 'Contacto recibido, tendré una respuesta pronto para ti. Gracias!');
      } catch (\Exception $exception){
        $this->get('session')->getFlashBag()->set('error', 'Error al enviar el formulario, si persiste prueba con mi whatsapp +5493584201876. Gracias!');
      }
      // $form->getData() holds the submitted values
      // but, the original `$task` variable has also been updated
      //$contact = $form->getData();

      // ... perform some action, such as saving the task to the database
      // for example, if Task is a Doctrine entity, save it!


      return $this->redirectToRoute('homepage');
    }
      return $this->render('homepage/index.html.twig', [
        'posts' => $posts,
        'form' => $form->createView(),
      ]);
  }
}

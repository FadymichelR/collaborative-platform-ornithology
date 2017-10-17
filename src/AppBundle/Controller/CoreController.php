<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Bird;
use AppBundle\Entity\Observation;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use AppBundle\Services\Mail;
use Symfony\Component\HttpFoundation\JsonResponse;

class CoreController extends Controller
{
    /**
     * @Route("/", name="core_home")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('core/index.html.twig');
    }

    /**
     * @Route("/find/", name="find")
     */
    public function findAction(Request $request)
	{
	    $defaultData = array('message' => 'find here');
	    $form = $this->createFormBuilder($defaultData)
	        ->add('mySearch', TextType::class, array(

              'attr' => array(
                  'placeholder' => 'core.find.input_find','class' => 'form-control search-input input-lg',
              )))
	        ->getForm();

	    $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        // data is an array with "name", "email", and "message" keys
	        $data = $form->getData();
	    }

	    return $this->render('core/find.html.twig', array('form' => $form->createView()));
	}
    /**
     * @Route("/bird/{id}", name="bird")
     */
    public function birdAction($id)
	{
	    $bird = $this->getDoctrine()
	        ->getRepository(Bird::class)
	        ->find($id);
        $observations = $this->getDoctrine()
	        ->getRepository(Observation::class)
	        ->findBy(array( 'birdId' => $id));

	    if (!$bird) {
	        throw $this->createNotFoundException(
	            'Cet ID ne correspond à aucun oiseau.'
	        );
	    }

	    return $this->render('core/bird.html.twig', array('bird' => $bird, 'observations' => $observations));
	}
	/**
     * @Route("/contact", name="app_contact")
     * @Method({"GET", "POST"})
     */
    public function contactAction(Request $request)
    {
		$contact = new Contact();
		$formBuilder = $this->get('form.factory')->create(ContactType::class, $contact);
			if ($request->isMethod('POST')) {
				$formBuilder->handleRequest($request);
				if ($formBuilder->isValid()) {
      
					$em = $this->getDoctrine()->getManager();
					$em->persist($contact);
					$em->flush();
		              $mail = $this->get(Mail::class);
		              $mailer_admin = $this->container->getParameter('mailer_user');
		              $mail->send(
		                $contact->getEmail(), $mailer_admin,
		                'Prise de contact depuis la Platforme',
		                $this->renderView('mail/contact.html.twig',array('contact' => $contact))
		                );
		              if ($request->isXmlHttpRequest()) { 
		              	  return new JsonResponse(array('status'=>'success'));
		              }
		              else {

			              $session = $request->getSession();
			              $session->getFlashBag()->add('contact-notice', 'Votre message vient d\'être envoyé, nous vous répondrons dans les plus brefs délais.');
	    				  return $this->redirect($this->generateUrl('app_contact'));
    				}
				}
				else {

	              if ($request->isXmlHttpRequest()) { 
	              	  return new JsonResponse(array('status'=>'error'));
	              }
	          	}
			}
		return $this->render('core/contact.html.twig', array(
		'form' => $formBuilder->createView()
		));
    }
}

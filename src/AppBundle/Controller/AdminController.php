<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Observation;

class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_home")
     * @Method("GET")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $users = $em->getRepository('UserBundle:User')
                      ->findAll();

        $observations = $em->getRepository('AppBundle:Observation')
                     ->findAll();

        return $this->render('admin/index.html.twig', array(
            'users' => $users,
            'observations' => $observations
        ));
    }

    /**
     * @Route("/obs/validate/{id}", requirements={"id" = "\d+"}, name="admin_obs_validate")
     * @Method("GET")
     */
    public function obsValidateAction(EntityManagerInterface $em, Observation $obs)
    {
        $obs->setStatus(true);

        $em->persist($obs);
        $em->flush();

        return $this->redirectToRoute('admin_home');
    }





    /**
     * @Route("/obs/await/{id}", requirements={"id" = "\d+"}, name="admin_obs_await")
     * @Method("GET")
     */
    public function obsAwaitAction(EntityManagerInterface $em, Observation $obs)
    {
        $obs->setStatus(null);

        $em->persist($obs);
        $em->flush();

        return $this->redirectToRoute('admin_home');
    }





    /**
     * @Route("/obs/refuse/{id}", requirements={"id" = "\d+"}, name="admin_obs_refuse")
     * @Method("GET")
     */
    public function obsRefuseAction(EntityManagerInterface $em, Observation $obs)
    {
        $obs->setStatus(false);

        $em->persist($obs);
        $em->flush();

        return $this->redirectToRoute('admin_home');
    }
}

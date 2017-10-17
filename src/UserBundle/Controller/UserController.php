<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use UserBundle\Entity\User;
use UserBundle\Form\Type\UserEditType;

class UserController extends Controller
{
    /**
     * @Route("/delete/{id}", requirements={"id" = "\d+"}, name="admin_user_delete")
     * @Method("GET")
     */
    public function userDeleteAction(UserManagerInterface $um, User $user)
    {
        $um->deleteUser($user);

        return $this->redirectToRoute('admin_home');
    }





    /**
     * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="admin_user_edit")
     * @Method({"GET", "POST"})
     */
    public function userEditAction(Request $request, EntityManagerInterface $em, UserManagerInterface $um, User $user)
    {
        $form = $this->createForm(UserEditType::class, $user);

        $form->handleRequest($request);
        
        if ( $form->isSubmitted() ) {
            if ( $form->isValid() ) {
                $um->updateUser($user);   
            }
            
            return $this->redirectToRoute('admin_home');
        }
        
        return $this->render('form/user_edit_form.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }
}

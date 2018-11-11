<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function allAction(Request $request)
    {
        $params=array();
        $one=null;
        if($request->query->has('id'))
            $params["id"]=$request->get("id");
        if($request->query->has('password'))
            $params["password"]=$request->get("password");
        if($request->query->has('email'))
            $params["email"]=$request->get("email");
        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('EntitiesBundle:User')->findBy($params);
        }
        $data = array();
        if($users!=null) {
            forEach($users as $one) {
                $data[] = array("id" => $one->getId(), "email" => $one->getEmail(), "password" => $one->getPassword());
            }
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    public function indexAction(Request $request)
    {
        $params=array();
        $one=null;
        if($request->query->has('id'))
            $params["id"]=$request->get("id");
        if($request->query->has('password'))
            $params["password"]=$request->get("password");
        if($request->query->has('email'))
            $params["email"]=$request->get("email");
        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $one = $em->getRepository('EntitiesBundle:User')->findOneBy($params);
        }
        $data = array();
        if($one!=null) {
            $data[] = array("id" => $one->getId(), "email" => $one->getEmail(), "password" => $one->getPassword());
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('EntitiesBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('EntitiesBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

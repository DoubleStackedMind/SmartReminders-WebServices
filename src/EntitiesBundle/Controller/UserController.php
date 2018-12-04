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
     * Lists all user entities as JSONArray.
     * @param Request $request
     * @return Response
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
        if($request->query->has('name'))
            $params["name"]=$request->get("name");
        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('EntitiesBundle:User')->findBy($params);
        }
        $data = array();
        if($users!=null) {
            forEach($users as $one) {
                $data[] = array("id" => $one->getId(), "email" => $one->getEmail(), "password" => $one->getPassword(),"name"=>$one->getName());
            }
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**
     * Lists one user entities as JSONObject.
     * @param Request $request
     * @return Response
     */
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
        if($request->query->has('name'))
            $params["name"]=$request->get("name");
        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $one = $em->getRepository('EntitiesBundle:User')->findOneBy($params);
        }
        $data = array();
        if($one!=null) {
            $data[] = array("id" => $one->getId(), "email" => $one->getEmail(), "password" => $one->getPassword(),"name"=>$one->getName());
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
        $data=array("result"=>"missing params");

        if($request->get("password")!=null&&$request->get("email")!=null&&$request->get("name")!=null)
        { $user = new User();
        $user->setEmail($request->get("email"));
        $user->setPassword($request->get("password"));
        $user->setName($request->get("name"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


           $data=array("result"=>"ok");
        }
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

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
    public function editAction(Request $request)
    {
        $data=array("result"=>"missing params");

        if($request->get("id")!=null&&$request->get("email")!=null&&$request->get("name")!=null&&$request->get("password"))
        {   $em = $this->getDoctrine()->getManager();
            $user =$em->find(User::class,$request->get("id"));
            $user->setEmail($request->get("email"));
            $user->setPassword($request->get("password"));
            $user->setName($request->get("name"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $data=array("result"=>"ok");
        }
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
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
            ->getForm();
    }
}

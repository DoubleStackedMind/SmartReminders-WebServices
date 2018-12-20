<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\Action;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Action controller.
 *
 */
class ActionController extends Controller
{
    /**
     * Lists all action entities.
     *
     */
    public function indexAction(Request $request)
    {
        $params=array();
        $one=null;
        if($request->query->has('id'))
            $params["id"]=$request->get("id");
        if($request->query->has('name'))
            $params["name"]=$request->get("name");
        if($request->query->has('icon'))
            $params["icon"]=$request->get("icon");
        if($request->query->has('task'))
            $params["task"]=$request->get("task");
        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $one = $em->getRepository('EntitiesBundle:Action')->findOneBy($params);
        }
        $data = array();
        if($one!=null) {
            $data[] = array("id" => $one->getId(), "name" => $one->getName(), "icon" => $one->getIcon(),"task"=>$one->getTask());
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    /**
     * Creates a new action entity.
     *
     */
    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");
        $action = new Action();
        $form = $this->createForm('EntitiesBundle\Form\ActionType', $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($action);
            $em->flush();

            $data=array("result"=>"ok");
        }
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Finds and displays a action entity.
     *
     */
    public function showAction(Action $action)
    {
        $deleteForm = $this->createDeleteForm($action);

        return $this->render('action/show.html.twig', array(
            'action' => $action,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing action entity.
     *
     */
    public function editAction(Request $request, Action $action)
    {
        $data=array("result"=>"missing params");
        $deleteForm = $this->createDeleteForm($action);
        $editForm = $this->createForm('EntitiesBundle\Form\ActionType', $action);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $data=array("result"=>"ok");
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Deletes a action entity.
     *
     */
    public function deleteAction(Request $request, Action $action)
    {
        $form = $this->createDeleteForm($action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($action);
            $em->flush();
        }

        return new JsonResponse("ok");
    }

    /**
     * Creates a form to delete a action entity.
     *
     * @param Action $action The action entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Action $action)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('action_delete', array('id' => $action->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

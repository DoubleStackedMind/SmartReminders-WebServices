<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\Triggger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Triggger controller.
 *
 */
class TrigggerController extends Controller
{
    /**
     * Lists all triggger entities.
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
            $one = $em->getRepository('EntitiesBundle:Triggger')->findOneBy($params);
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
     * Creates a new triggger entity.
     *
     */
    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");
        $triggger = new Triggger();
        $form = $this->createForm('EntitiesBundle\Form\TrigggerType', $triggger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($triggger);
            $em->flush();

            $data=array("result"=>"ok");
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        }

    /**
     * Finds and displays a triggger entity.
     *
     */
    public function showAction(Triggger $triggger)
    {
        $deleteForm = $this->createDeleteForm($triggger);

        return $this->render('triggger/show.html.twig', array(
            'triggger' => $triggger,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing triggger entity.
     *
     */
    public function editAction(Request $request, Triggger $triggger)
    {
        $data=array("result"=>"missing params");

        $deleteForm = $this->createDeleteForm($triggger);
        $editForm = $this->createForm('EntitiesBundle\Form\TrigggerType', $triggger);
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
     * Deletes a triggger entity.
     *
     */
    public function deleteAction(Request $request, Triggger $triggger)
    {
        $form = $this->createDeleteForm($triggger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($triggger);
            $em->flush();
        }

        return new JsonResponse("ok");
    }

    /**
     * Creates a form to delete a triggger entity.
     *
     * @param Triggger $triggger The triggger entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Triggger $triggger)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('triggger_delete', array('id' => $triggger->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

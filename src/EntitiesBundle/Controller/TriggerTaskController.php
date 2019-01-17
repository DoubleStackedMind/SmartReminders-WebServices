<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\TriggerTask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Triggertask controller.
 *
 */
class TriggerTaskController extends Controller
{
    /**
     * Lists all triggerTask entities.
     *
     */
    public function indexAction(Request $request)
    {
        $params=array();
        $one=null;
        if($request->query->has('triggers'))
            $params["triggers"]=$request->get("triggers");

        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $one = $em->getRepository('EntitiesBundle:TriggerTask')->findOneBy($params);
        }
        $data = array();
        if($one!=null) {
            $data[] = array("trigger" => $one->getTriggers());
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new triggerTask entity.
     *
     */
    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");
        $triggerTask = new Triggertask();
        $form = $this->createForm('EntitiesBundle\Form\TriggerTaskType', $triggerTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($triggerTask);
            $em->flush();

            $data=array("result"=>"ok");
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * Finds and displays a triggerTask entity.
     *
     */
    public function showAction(TriggerTask $triggerTask)
    {
        $deleteForm = $this->createDeleteForm($triggerTask);

        return $this->render('triggertask/show.html.twig', array(
            'triggerTask' => $triggerTask,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing triggerTask entity.
     *
     */
    public function editAction(Request $request, TriggerTask $triggerTask)
    {
        $data=array("result"=>"missing params");

        $editForm = $this->createForm('EntitiesBundle\Form\TriggerTaskType', $triggerTask);
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
     * Deletes a triggerTask entity.
     *
     */
    public function deleteAction(Request $request, TriggerTask $triggerTask)
    {
        $form = $this->createDeleteForm($triggerTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($triggerTask);
            $em->flush();
        }

        return new JsonResponse("ok");
    }

    /**
     * Creates a form to delete a triggerTask entity.
     *
     * @param TriggerTask $triggerTask The triggerTask entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TriggerTask $triggerTask)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('triggertask_delete', array('id' => $triggerTask->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction(Request $request)
    {
        $params=array();
        $one=null;
        if($request->query->has('startTime'))
            $params["startTime"]=$request->get("startTime");
        if($request->query->has('endTime'))
            $params["endTime"]=$request->get("endTime");
        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $one = $em->getRepository('EntitiesBundle:Event')->findOneBy($params);
        }
        $data = array();
        if($one!=null) {
            $data[] = array("startTime" => $one->getStartTime(), "endTime" => $one->getEndTime());
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");
        $event = new Event();
        $form = $this->createForm('EntitiesBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $data=array("result"=>"ok");
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('event/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Event $event)
    {
        $data=array("result"=>"missing params");
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('EntitiesBundle\Form\EventType', $event);
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
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return new JsonResponse("ok");
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

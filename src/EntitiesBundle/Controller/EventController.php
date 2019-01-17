<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\Event;
use EntitiesBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EntitiesBundle:Event')->findAll();

        return $this->render('event/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $data = array("result" => "missing params");
        if ( $request->get("reminderETA") && $request->get("startTime") != null && $request->get("description") != null && $request->get("state") != null && $request->get("days") != null && $request->get("user") != null && $request->get("title") != null && $request->get("endTime") != null) {
            $em = $this->getDoctrine()->getManager();
            $event = new Event();
            $event->setDayofweek($request->get("days"));
            $event->setStartTime($request->get("startTime"));
            $event->setState($request->get("state"));
            $event->setUser($em->find(User::class, $request->get("user")));
            $event->setDescription($request->get("description"));
            $event->setTitle($request->get("title"));
            $event->setEndTime($request->get("endTime"));
            $event->setReminderETA($request->get("reminderETA"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $data = array("result" => "ok");
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

        $editForm = $this->createForm('EntitiesBundle\Form\TriggerTaskType', $event);
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

    public function allAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class,$request->get("user"));
        $event = $em->getRepository('EntitiesBundle:Event')->findAll(array("user"=>$user));
        if($event!=null) {
            forEach ($event as $one) {
                $data[] = array(
                    "state"=>$one->getState(),
                    "title"=>$one->getTitle(),
                    "id" => $one->getId(),
                    "startTime" => $one->getStartTime(),
                    "description" => $one->getDescription(),
                    "days" => $one->getDayofweek(),
                    "user"=>$one->getUser(),
                    "endTime"=>$one->getEndTime(),
                    "reminderETA"=>$one->getReminderETA());
            }
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
}

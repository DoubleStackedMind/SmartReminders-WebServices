<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\TimeTask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Timetask controller.
 *
 */
class TimeTaskController extends Controller
{
    /**
     * Lists all timeTask entities.
     *
     */
    public function indexAction(Request $request)
    {
        $params=array();
        $one=null;
        if($request->query->has('executionTime'))
            $params["executionTime"]=$request->get("executionTime");
        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('EntitiesBundle:TimeTask')->findBy($params);
        }
        $data = array();
        if($users!=null) {
            forEach($users as $one) {
                $data[] = array("executionTime" => $one->getExecutionTime());
            }
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new timeTask entity.
     *
     */
    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");

        $timeTask = new Timetask();
        $form = $this->createForm('EntitiesBundle\Form\TimeTaskType', $timeTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($timeTask);
            $em->flush();

            $data=array("result"=>"ok");
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * Finds and displays a timeTask entity.
     *
     */
    public function showAction(TimeTask $timeTask)
    {
        $deleteForm = $this->createDeleteForm($timeTask);

        return $this->render('timetask/show.html.twig', array(
            'timeTask' => $timeTask,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing timeTask entity.
     *
     */
    public function editAction(Request $request, TimeTask $timeTask)
    {
        $data=array("result"=>"missing params");

        $deleteForm = $this->createDeleteForm($timeTask);
        $editForm = $this->createForm('EntitiesBundle\Form\TimeTaskType', $timeTask);
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
     * Deletes a timeTask entity.
     *
     */
    public function deleteAction(Request $request, TimeTask $timeTask)
    {
        $form = $this->createDeleteForm($timeTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($timeTask);
            $em->flush();
        }

        return new JsonResponse("ok");
    }

    /**
     * Creates a form to delete a timeTask entity.
     *
     * @param TimeTask $timeTask The timeTask entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TimeTask $timeTask)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('timetask_delete', array('id' => $timeTask->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

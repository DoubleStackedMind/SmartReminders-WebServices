<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\Action;
use EntitiesBundle\Entity\TimeTask;
use EntitiesBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Timetask controller.
 *
 */
class TimeTaskController extends Controller
{


    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class,$request->get("user"));
        $timetasks = $em->getRepository('EntitiesBundle:TimeTask')->findAll(array("user"=>$user));
        if($timetasks!=null) {
            forEach ($timetasks as $one) {
                $data[] = array("state"=>$one->getState(),"title"=>$one->getTitle(),"id" => $one->getId(), "executionTime" => $one->getExecutionTime(), "description" => $one->getDescription(), "days" => $one->getDayofweek(),"user"=>$one->getUser(),"actions"=>$one->getActions());
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
        $data = array("result" => "missing params");

        if ($request->get("executionTime") != null && $request->get("description") != null && $request->get("state") != null && $request->get("days") != null && $request->get("user") != null && $request->get("title") != null && $request->get("actions") != null) {
            $em = $this->getDoctrine()->getManager();
            $timetask = new TimeTask();
            $timetask->setDayofweek($request->get("days"));
            $timetask->setExecutionTime($request->get("executionTime"));
            $timetask->setState($request->get("state"));
            $timetask->setUser($em->find(User::class, $request->get("user")));
            $timetask->setDescription($request->get("description"));
            $timetask->setTitle($request->get("title"));
            $timetask->setActions($request->get("actions"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($timetask);
            $em->flush();
            $data = array("result" => "ok");
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
        $deleteForm = $this->createDeleteForm($timeTask);
        $editForm = $this->createForm('EntitiesBundle\Form\TimeTaskType', $timeTask);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timetask_edit', array('id' => $timeTask->getId()));
        }

        return $this->render('timetask/edit.html.twig', array(
            'timeTask' => $timeTask,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a timeTask entity.
     *
     */
    public function deleteAction(Request $request)
    {
        $data=array("result"=>"missing params");
        if ($request->get("id")!=null){
            $em = $this->getDoctrine()->getManager();
            $timeTask= $em->find(TimeTask::class,$request->get("id"));
            $em->remove($timeTask);
            $em->flush();
            $data=array("result"=>"ok");
        }
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
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
            ->getForm();
    }
    public function allAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class,$request->get("user"));
        $timetasks = $em->getRepository('EntitiesBundle:TimeTask')->findAll(array("user"=>$user));
        if($timetasks!=null) {
            forEach ($timetasks as $one) {
                $data[] = array("state"=>$one->getState(),"title"=>$one->getTitle(),"id" => $one->getId(), "executionTime" => $one->getExecutionTime(), "description" => $one->getDescription(), "days" => $one->getDayofweek(),"user"=>$one->getUser(),"actions"=>$one->getActions());
            }
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
}

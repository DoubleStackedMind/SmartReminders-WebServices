<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\TimeTask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $timeTasks = $em->getRepository('EntitiesBundle:TimeTask')->findAll();

        return $this->render('timetask/index.html.twig', array(
            'timeTasks' => $timeTasks,
        ));
    }

    /**
     * Creates a new timeTask entity.
     *
     */
    public function newAction(Request $request)
    {
        $timeTask = new Timetask();
        $form = $this->createForm('EntitiesBundle\Form\TimeTaskType', $timeTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($timeTask);
            $em->flush();

            return $this->redirectToRoute('timetask_show', array('id' => $timeTask->getId()));
        }

        return $this->render('timetask/new.html.twig', array(
            'timeTask' => $timeTask,
            'form' => $form->createView(),
        ));
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
    public function deleteAction(Request $request, TimeTask $timeTask)
    {
        $form = $this->createDeleteForm($timeTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($timeTask);
            $em->flush();
        }

        return $this->redirectToRoute('timetask_index');
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

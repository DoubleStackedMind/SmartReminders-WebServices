<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\TriggerTask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $triggerTasks = $em->getRepository('EntitiesBundle:TriggerTask')->findAll();

        return $this->render('triggertask/index.html.twig', array(
            'triggerTasks' => $triggerTasks,
        ));
    }

    /**
     * Creates a new triggerTask entity.
     *
     */
    public function newAction(Request $request)
    {
        $triggerTask = new Triggertask();
        $form = $this->createForm('EntitiesBundle\Form\TriggerTaskType', $triggerTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($triggerTask);
            $em->flush();

            return $this->redirectToRoute('triggertask_show', array('id' => $triggerTask->getId()));
        }

        return $this->render('triggertask/new.html.twig', array(
            'triggerTask' => $triggerTask,
            'form' => $form->createView(),
        ));
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
        $deleteForm = $this->createDeleteForm($triggerTask);
        $editForm = $this->createForm('EntitiesBundle\Form\TriggerTaskType', $triggerTask);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('triggertask_edit', array('id' => $triggerTask->getId()));
        }

        return $this->render('triggertask/edit.html.twig', array(
            'triggerTask' => $triggerTask,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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

        return $this->redirectToRoute('triggertask_index');
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

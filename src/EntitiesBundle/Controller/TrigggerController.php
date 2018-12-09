<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\Triggger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trigggers = $em->getRepository('EntitiesBundle:Triggger')->findAll();

        return $this->render('triggger/index.html.twig', array(
            'trigggers' => $trigggers,
        ));
    }

    /**
     * Creates a new triggger entity.
     *
     */
    public function newAction(Request $request)
    {
        $triggger = new Triggger();
        $form = $this->createForm('EntitiesBundle\Form\TrigggerType', $triggger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($triggger);
            $em->flush();

            return $this->redirectToRoute('triggger_show', array('id' => $triggger->getId()));
        }

        return $this->render('triggger/new.html.twig', array(
            'triggger' => $triggger,
            'form' => $form->createView(),
        ));
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
        $deleteForm = $this->createDeleteForm($triggger);
        $editForm = $this->createForm('EntitiesBundle\Form\TrigggerType', $triggger);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('triggger_edit', array('id' => $triggger->getId()));
        }

        return $this->render('triggger/edit.html.twig', array(
            'triggger' => $triggger,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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

        return $this->redirectToRoute('triggger_index');
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

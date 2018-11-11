<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\DailyPlan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Dailyplan controller.
 *
 */
class DailyPlanController extends Controller
{
    /**
     * Lists all dailyPlan entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dailyPlans = $em->getRepository('EntitiesBundle:DailyPlan')->findAll();

        return $this->render('dailyplan/index.html.twig', array(
            'dailyPlans' => $dailyPlans,
        ));
    }

    /**
     * Creates a new dailyPlan entity.
     *
     */
    public function newAction(Request $request)
    {
        $dailyPlan = new Dailyplan();
        $form = $this->createForm('EntitiesBundle\Form\DailyPlanType', $dailyPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dailyPlan);
            $em->flush();

            return $this->redirectToRoute('dailyplan_show', array('id' => $dailyPlan->getId()));
        }

        return $this->render('dailyplan/new.html.twig', array(
            'dailyPlan' => $dailyPlan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dailyPlan entity.
     *
     */
    public function showAction(DailyPlan $dailyPlan)
    {
        $deleteForm = $this->createDeleteForm($dailyPlan);

        return $this->render('dailyplan/show.html.twig', array(
            'dailyPlan' => $dailyPlan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dailyPlan entity.
     *
     */
    public function editAction(Request $request, DailyPlan $dailyPlan)
    {
        $deleteForm = $this->createDeleteForm($dailyPlan);
        $editForm = $this->createForm('EntitiesBundle\Form\DailyPlanType', $dailyPlan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dailyplan_edit', array('id' => $dailyPlan->getId()));
        }

        return $this->render('dailyplan/edit.html.twig', array(
            'dailyPlan' => $dailyPlan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dailyPlan entity.
     *
     */
    public function deleteAction(Request $request, DailyPlan $dailyPlan)
    {
        $form = $this->createDeleteForm($dailyPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dailyPlan);
            $em->flush();
        }

        return $this->redirectToRoute('dailyplan_index');
    }

    /**
     * Creates a form to delete a dailyPlan entity.
     *
     * @param DailyPlan $dailyPlan The dailyPlan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DailyPlan $dailyPlan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dailyplan_delete', array('id' => $dailyPlan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

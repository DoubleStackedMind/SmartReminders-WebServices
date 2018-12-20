<?php

namespace EntitiesBundle\Controller;

use EntitiesBundle\Entity\User;
use EntitiesBundle\Entity\Zone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Zone controller.
 *
 */
class ZoneController extends Controller
{
    /**
     * Lists all zone entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class,$request->get("user"));
        $zones = $em->getRepository('EntitiesBundle:Zone')->findAll(array("user"=>$user));
        if($zones!=null) {
            forEach ($zones as $one) {
                $data[] = array("name"=>$one->getName(),"id" => $one->getId(), "lat" => $one->getLat(), "lng" => $one->getlog(), "radius" => $one->getRadius(),"user"=>$one->getUser()->getId());
            }
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new zone entity.
     *
     */
    public function newAction(Request $request)
    {

        $data=array("result"=>"missing params");

        if($request->get("lng")!=null&&$request->get("lat")!=null&&$request->get("radius")!=null&&$request->get("name")!=null&&$request->get("user")!=null)
        {
            $em = $this->getDoctrine()->getManager();
            $zone = new Zone();
            $zone->setLat($request->get("lat"));
            $zone->setLog($request->get("lng"));
            $zone->setName($request->get("name"));
            $zone->setRadius($request->get("radius"));
            $zone->setUser($em->find(User::class,$request->get("user")));
            $em = $this->getDoctrine()->getManager();
            $em->persist($zone);
            $em->flush();
            $data=array("result"=>"ok");
        }
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Finds and displays a zone entity.
     *
     */
    public function showAction(Zone $zone)
    {
        $deleteForm = $this->createDeleteForm($zone);

        return $this->render('zone/show.html.twig', array(
            'zone' => $zone,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing zone entity.
     *
     */
    public function editAction(Request $request, Zone $zone)
    {
        $deleteForm = $this->createDeleteForm($zone);
        $editForm = $this->createForm('EntitiesBundle\Form\ZoneType', $zone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zone_edit', array('id' => $zone->getId()));
        }

        return $this->render('zone/edit.html.twig', array(
            'zone' => $zone,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a zone entity.
     *
     */
    public function deleteAction(Request $request)
    {
        $data=array("result"=>"missing params");
        if ($request->get("id")!=null){
            $em = $this->getDoctrine()->getManager();
            $zone= $em->find(Zone::class,$request->get("id"));
            $em->remove($zone);
            $em->flush();
            $data=array("result"=>"ok");
        }
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Creates a form to delete a zone entity.
     *
     * @param Zone $zone The zone entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Zone $zone)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zone_delete', array('id' => $zone->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function allAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class,$request->get("user"));
        $zones = $em->getRepository('EntitiesBundle:Zone')->findAll(array("user"=>$user));
        if($zones!=null) {
            forEach ($zones as $one) {
                $data[] = array("name"=>$one->getName(),"id" => $one->getId(), "lat" => $one->getLat(), "lng" => $one->getlog(), "radius" => $one->getRadius(),"user"=>$one->getUser()->getId());
            }
        }
        $response = new Response(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
}

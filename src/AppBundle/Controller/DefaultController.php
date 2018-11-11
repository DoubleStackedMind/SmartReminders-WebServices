<?php

namespace AppBundle\Controller;

use AppBundle\Entity\user;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/", name="login")
     */
    public function LoginWebServiceFunctionAction (Request $request)
    {
        $us = new user();
        $user = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:User')->findOneBy(array(['username' => $request->get('username')]));
        $us->setIduser($user);
        $us->setUsername($user);
        $us->setPwd($user);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($us);
        return new JsonResponse($formatted);
    }
}

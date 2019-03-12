<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\CandidatureType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/candidature")
 * Class OperationController
 * @package App\Controller
 */
class CandidatureController extends AbstractController
{
    /**
     * @Route("/new" , name ="candidature_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($candidature);
            $em->flush();

            return $this->redirectToRoute('candidature_list');
        }

        return $this->render('candidature/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{candidature}" , name ="candidature_edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Candidature $candidature)
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($candidature);
            $em->flush();

            return $this->redirectToRoute('candidature_list');
        }

        return $this->render('candidature/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/delete/{id}" , name ="candidature_delete")
     * @param Request $request
     */
    public function delete(Request $request)
    {

    }

    /**
     * @Route("/list", name="candidature_list")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(Request $request)
    {
        $operation = new Candidature();
        $form = $this->createForm(CandidatureType::class, $operation);
        $form->handleRequest($request);

        return $this->render('candidature/list.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

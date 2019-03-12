<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/contrat")
 * Class OperationController
 * @package App\Controller
 */
class ContratController extends AbstractController
{
    /**
     * @Route("/new" , name ="contrat_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contrat);
            $em->flush();

            return $this->redirectToRoute('contrat_list');
        }

        return $this->render('contrat/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{contrat}" , name ="contrat_edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Contrat $contrat)
    {
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contrat);
            $em->flush();

            return $this->redirectToRoute('contrat_list');
        }

        return $this->render('contrat/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/delete/{id}" , name ="contrat_delete")
     * @param Request $request
     */
    public function delete(Request $request)
    {

    }

    /**
     * @Route("/list", name="contrat_list")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(Request $request)
    {
        $operation = new Contrat();
        $form = $this->createForm(ContratType::class, $operation);
        $form->handleRequest($request);

        return $this->render('contrat/list.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

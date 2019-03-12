<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/competence")
 * Class OperationController
 * @package App\Controller
 */
class CompetenceController extends AbstractController
{
    /**
     * @Route("/new" , name ="competence_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($competence);
            $em->flush();

            return $this->redirectToRoute('competence_list');
        }

        return $this->render('competence/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{competence}" , name ="competence_edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Competence $competence)
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($competence);
            $em->flush();

            return $this->redirectToRoute('competence_list');
        }

        return $this->render('competence/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/delete/{id}" , name ="competence_delete")
     * @param Request $request
     */
    public function delete(Request $request)
    {

    }

    /**
     * @Route("/list", name="competence_list")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(Request $request)
    {
        $operation = new Competence();
        $form = $this->createForm(CompetenceType::class, $operation);
        $form->handleRequest($request);

        return $this->render('competence/list.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/job")
 * Class OperationController
 * @package App\Controller
 */
class JobController extends AbstractController
{
    /**
     * @Route("/new" , name ="job_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job_list');
        }

        return $this->render('job/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{job}" , name ="job_edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Job $job)
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job_list');
        }

        return $this->render('job/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/delete/{id}" , name ="job_delete")
     * @param Request $request
     */
    public function delete(Request $request)
    {

    }

    /**
     * @Route("/list", name="job_list")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(Request $request)
    {
        $operation = new Job();
        $form = $this->createForm(JobType::class, $operation);
        $form->handleRequest($request);

        return $this->render('job/list.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

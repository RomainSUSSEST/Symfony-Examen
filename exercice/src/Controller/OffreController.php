<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/offre")
 * Class OperationController
 * @package App\Controller
 */
class OffreController extends AbstractController
{
    /**
     * @Route("/new" , name ="offre_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();

            return $this->redirectToRoute('offre_list');
        }

        return $this->render('offre/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{offre}" , name ="offre_edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Offre $offre)
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();

            return $this->redirectToRoute('offre_list');
        }

        return $this->render('offre/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/delete/{id}" , name ="offre_delete")
     * @param Request $request
     */
    public function delete(Request $request)
    {

    }

    /**
     * @Route("/list", name="offre_list")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(Request $request)
    {
        $operation = new Offre();
        $form = $this->createForm(OffreType::class, $operation);
        $form->handleRequest($request);

        $offres = $this->getDoctrine()
            ->getRepository('AppBundle:Offre')
            ->findAll();

        if (!$offres) {
            throw $this->createNotFoundException(
                'Aucune offre trouvée.'
            );
        }


        return $this->render('offre/list.html.twig', array('offres' => $offres)
        );
    }
}

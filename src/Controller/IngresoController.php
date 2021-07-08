<?php

namespace App\Controller;

use App\Entity\FacturaReserva;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngresoController extends AbstractController
{
    /**
     * @Route("/ingresos", name="ingresos")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $facturaReserva = $em->getRepository(FacturaReserva::class)->findAll();

        return $this->render('ingreso/index.html.twig', [
            'facturaReserva' => $facturaReserva
        ]);
    }
}

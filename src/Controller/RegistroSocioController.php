<?php

namespace App\Controller;

use src\Controller\IndexController;
use App\Entity\Socio;
use App\Form\SocioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistroSocioController extends AbstractController
{
    /**
     * @Route("/registro/socio", name="registro_socio")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $socio = new Socio();
        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $socio->setPassword(
                $passwordEncoder->encodePassword(
                    $socio,
                    $form->get('password')->getData()
                    )
                );
            $em->persist($socio);
            $em->flush();
            $this->addFlash('success', Socio::REGISTRO_OK);
            return $this->redirectToRoute('registro_socio');
        }
        return $this->render('registro_socio/index.html.twig', [
            'formulario' => $form->createView()
        ]);
    }
}

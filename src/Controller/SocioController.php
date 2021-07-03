<?php

namespace App\Controller;

use App\Entity\Socio;
use App\Form\SocioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SocioController extends AbstractController
{
    /**
     * @Route("/socios", name="socio")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $socio = $em->getRepository(Socio::class)->findAll();
        return $this->render('socio/index.html.twig', [
            'socios' => $socio
        ]);
    }

    /**
     * @Route("/socios/crear", name="crear_socio")
     */
    public function crearSocio(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
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
            return $this->redirectToRoute('socio');
        }
        return $this->render('socio/crear.html.twig', [
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/socios/modificar/{id}", name="modificar_socio")
     */
    public function modificarSocio($id, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $em = $this->getDoctrine()->getManager();
        $socio = $em->getRepository(Socio::class)->find($id);
        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $socio->setPassword(
                $passwordEncoder->encodePassword(
                    $socio,
                    $form->get('password')->getData()
                )
            );
            $em->flush();
            return $this->redirectToRoute('socio');
        }

        return $this->render('socio/modificar.html.twig', [
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/socios/archivar/{id}", name="archivar_socio")
     */
    public function archivarSocio($id)
    {
        $em = $this->getDoctrine()->getManager();
        $socio = $em->getRepository(Socio::class)->find($id);
        $socio->setArchivado(1);
        $em->flush();

        return $this->redirectToRoute('socio');
    }

    /**
     * @Route("/socios/desarchivar/{id}", name="desarchivar_socio")
     */
    public function desarchivarSocio($id)
    {
        $em = $this->getDoctrine()->getManager();
        $socio = $em->getRepository(Socio::class)->find($id);
        $socio->setArchivado(0);
        $em->flush();

        return $this->redirectToRoute('socio');
    }
}

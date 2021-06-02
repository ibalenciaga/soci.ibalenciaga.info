<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Form\NoticiaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoticiaController extends AbstractController
{
    /**
     * @Route("/noticias", name="noticia")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $noticias = $em->getRepository(Noticia::class)->findAll();
        return $this->render('noticia/index.html.twig', [
            'noticias' => $noticias
        ]);
    }

    /**
     * @Route("/noticias/crear", name="crear_noticia")
     */
    public function crearNoticia(Request $request): Response
    {
        $noticia = new Noticia();
        $form = $this->createForm(NoticiaType::class, $noticia);
        $form->handleRequest(($request));
        if($form->isSubmitted() && $form->isValid()){
            $socio = $this->getUser();
            $noticia->setSocio($socio);
            $em = $this->getDoctrine()->getManager();
            $em->persist($noticia);
            $em->flush();
            return $this->redirectToRoute('noticia');
        }
        return $this->render('noticia/crear.html.twig', [
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/noticias/modificar/{id}", name="modificar_noticia")
     */
    public function modificarNoticia($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $noticia = $em->getRepository(Noticia::class)->find($id);

        $form = $this->createForm(NoticiaType::class, $noticia);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $socio = $this->getUser();
            $noticia->setSocio($socio);
            $em->flush();
            return $this->redirectToRoute('noticia');
        }

        return $this->render('noticia/modificar.html.twig', [
            'formulario' => $form->createView()
        ]);
    }
}

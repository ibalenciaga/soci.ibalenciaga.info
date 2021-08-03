<?php

namespace App\Controller;

use App\Entity\Proveedor;
use App\Form\ProveedorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProveedorController extends AbstractController
{
    /**
     * @Route("/proveedores", name="proveedor")
     */
    public function index(): Response{
        $em = $this->getDoctrine()->getManager();
        $proveedores = $em->getRepository(Proveedor::class)->findAll();
        return $this->render('proveedor/index.html.twig', [
            'proveedores' => $proveedores,
        ]);
    }

    /**
     * @Route("/proveedores/crear", name="crear_proveedor")
     */
    public function crearProveedor(Request $request): Response{
        $proveedor = new Proveedor();
        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest(($request));
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($proveedor);
            $em->flush();
            return $this->redirectToRoute('proveedor');
        }
        return $this->render('proveedor/crear.html.twig', [
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/proveedores/modificar/{id}", name="modificar_proveedor")
     */
    public function modificarProveedor($id, Request $request): Response{
        $em = $this->getDoctrine()->getManager();
        $proveedor = $em->getRepository(Proveedor::class)->find($id);

        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('proveedor');
        }

        return $this->render('proveedor/modificar.html.twig', [
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/proveedores/archivar/{id}", name="archivar_proveedor")
     */
    public function archivarProveedor($id)
    {
        $em = $this->getDoctrine()->getManager();
        $proveedor = $em->getRepository(Proveedor::class)->find($id);
        $proveedor->setArchivado(1);
        $em->flush();

        return $this->redirectToRoute('proveedor');
    }
}

<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Form\ProductoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{
    /**
     * @Route("/productos", name="producto")
     */
    public function index(): Response{
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository(Producto::class)->findAll();
        return $this->render('producto/index.html.twig', [
            'productos' => $productos,
        ]);
    }

    /**
     * @Route("/productos/crear", name="crear_producto")
     */
    public function crearProducto(Request $request): Response{
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest(($request));
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();
            return $this->redirectToRoute('producto');
        }
        return $this->render('producto/crear.html.twig', [
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/productos/modificar/{id}", name="modificar_producto")
     */
    public function modificarProducto($id, Request $request): Response{
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository(Producto::class)->find($id);

        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('producto');
        }

        return $this->render('producto/modificar.html.twig', [
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/productos/eliminar/{id}", name="eliminar_producto")
     */
    public function eliminarProducto($id)
    {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository(Producto::class)->find($id);
        $em->remove($producto);
        $em->flush();


        return $this->redirectToRoute('producto');
    }
}

<?php

namespace App\Controller;

use App\Entity\ConsumicionReserva;
use App\Entity\FacturaReserva;
use App\Entity\Mesa;
use App\Entity\Producto;
use App\Entity\Reserva;
use App\Entity\ReservaMesa;
use App\Entity\Turno;
use App\Form\ReservaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservaController extends AbstractController
{
    /**
     * @Route("/reservas", name="reserva")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $reservas = $em->getRepository(Reserva::class)->findAll();
        foreach ($reservas as $reserva){
            $reservaMesa= $em->getRepository(ReservaMesa::class)->findByReservaId($reserva);
            foreach ($reservaMesa as $reserva_mesa){
                array_push($reserva->mesas, $reserva_mesa);
            }
            $factura_reserva = $em->getRepository(FacturaReserva::class)->findByReservaId($reserva);
            if(isset($factura_reserva) && $factura_reserva != null){
                $reserva->factura = $factura_reserva;
            }
        }
        return $this->render('reserva/index.html.twig', [
            'reservas' => $reservas
        ]);
    }

    /**
     * @Route("/reservas/crear", name="crear_reserva")
     */
    public function crearReserva(Request $request): Response
    {
        if($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_USER')){
            $reserva = new Reserva();
            $em = $this->getDoctrine()->getManager();

            $form = $this->createForm(ReservaType::class, $reserva);
            $form->handleRequest(($request));
            if (isset($_POST['submit'])){
                $socio = $this->getUser();
                $reserva->setSocio($socio);
                $turno_form = $form->get('turno')->getData();
                $turno = $em->getRepository(Turno::class)->find($turno_form->getTurno());
                $reserva->setTurno($turno);
                $reserva_existente = $em->getRepository(Reserva::class)->findReservaExistente($socio, $form->get('fecha')->getData()->format('Y-m-d'), $turno->getId());
                //guardamos la reserva si no existe
                if($reserva_existente == null){
                        $em->persist($reserva);
                        $em->flush();

                }else{
                    $comensales_nuevos = $form->get('comensales')->getData();
                    $comensales_existentes = $reserva_existente->getComensales();
                    $reserva = $reserva_existente;
                    $reserva->setComensales($comensales_nuevos + $comensales_existentes);

                    $em->flush();

                }
                $em->persist($reserva);
                //guardamos tambien la reserva en la tabla reserva_mesa
                foreach($_POST['mesas'] as $mesa_form){
                    $reservaMesa = new ReservaMesa();
                    $reservaMesa->setReserva($reserva);
                    $mesa = $em->getRepository(Mesa::class)->find($mesa_form);
                    $reservaMesa->setMesa($mesa);
                    $em->persist($reservaMesa);
                    $em->flush();
                }
                return $this->redirectToRoute('reserva');
            }
            $turnos = $em->getRepository(Turno::class)->findAll();
            $mesas_libres = $em->getRepository(Mesa::class)->findMesasLibres('2021-06-21',2);
            return $this->render('reserva/crear.html.twig', [
                'formulario' => $form->createView(),
                'turnos' => $turnos,
                'mesas_libres' => $mesas_libres
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/reservas/modificar/{id}", name="modificar_reserva")
     */
    public function modificarReserva($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $turno = $em->getRepository(Turno::class)->findAll();
        $reserva = $em->getRepository(Reserva::class)->find($id);

        $reservaMesa= $em->getRepository(ReservaMesa::class)->findByReservaId($reserva);

        $mesas_libres = $em->getRepository(Mesa::class)->findMesasLibres($reserva->getFecha()->format('Y-m-d'),$reserva->getTurno()->getId());
        $todas_mesas = $em->getRepository(Mesa::class)->findAll();

        if (isset($_POST['submit'])){
            $reserva->setComensales($_POST['reserva']['comensales']);
            $em->flush();
            //eliminamos la reserva antigua
            foreach ($reservaMesa as $reserva_mesa){
                try{
                    $em->remove($reserva_mesa);
                    $em->flush();
                }
                catch( Exception $e )
                {
                    return new Response( $e->getMessage(), 500 );
                }
            }
            //añadimos la nueva reserva
            foreach ($_POST['mesas'] as $mesas_nueva){
                try{
                    $reservaMesaNueva = new ReservaMesa();
                    $reservaMesaNueva->setReserva($reserva);
                    $mesa = $em->getRepository(Mesa::class)->find($mesas_nueva);
                    $reservaMesaNueva->setMesa($mesa);
                    $em->persist($reservaMesaNueva);
                    $em->flush();
                }
                catch( Exception $e )
                {
                    return new Response( $e->getMessage(), 500 );
                }
            }

            return $this->redirectToRoute('reserva');
        }

        return $this->render('reserva/modificar.html.twig', [
            'reserva' => $reserva,
            'reserva_mesa' => $reservaMesa,
            'mesas_libres' => $mesas_libres,
            'todas_mesas' => $todas_mesas,
            'turno' => $turno
        ]);
    }

    /**
     * @Route("/reservas/eliminar/{id}", name="eliminar_reserva")
     */
    public function eliminarReserva($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reserva = $em->getRepository(Reserva::class)->find($id);
        $reservaMesa= $em->getRepository(ReservaMesa::class)->findByReservaId($reserva);

        foreach ($reservaMesa as $reserva_mesa){
            $em->remove($reserva_mesa);
            $em->flush();
        }
        $em->remove($reserva);
        $em->flush();

        return $this->redirectToRoute('reserva');
    }

    /**
     * @Route("/reservas/{id}/pagar", name="pagar_reserva")
     */
    public function pagarReserva($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $reserva = $em->getRepository(Reserva::class)->find($id);
        $productos = $em->getRepository(Producto::class)->findAll();


        return $this->render('reserva/cuenta.html.twig', [
            'reserva' => $reserva,
            'productos' => $productos
        ]);
    }

    /**
     * @Route("/reservas/{id}/crear/factura", name="crear_factura_reserva")
     */
    public function crearFacturaReserva($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $reserva = $em->getRepository(Reserva::class)->find($id);
        $productos = $em->getRepository(Producto::class)->findAll();

        if (isset($_POST['submit'])){

            $factura_reserva = new FacturaReserva();
            $factura_reserva->setReserva($reserva);
            $precio = $_POST['reserva_precio'];
            $factura_reserva->setPrecio((float)$precio);
            $em->persist($factura_reserva);
            $em->flush();

            foreach ($_POST['producto'] as $i => $producto){
                if($producto['cantidad'] != null){
                    $consumicion_reserva = new ConsumicionReserva();
                    $consumicion_reserva->setReserva($reserva);
                    $producto_id = $em->getRepository(Producto::class)->find($producto['id']);
                    $consumicion_reserva->setProducto($producto_id);
                    $consumicion_reserva->setCantidad($producto['cantidad']);
                    $em->persist($consumicion_reserva);
                    $em->flush();
                }
            }

            return $this->redirectToRoute('ver_factura_reserva', array('id' => $reserva->getId()));
        }
        return $this->render('reserva/cuenta.html.twig', [
            'reserva' => $reserva,
            'productos' => $productos
        ]);
    }

    /**
     * @Route("/reservas/{id}/ver/factura", name="ver_factura_reserva")
     */
    public function verFacturaReserva($id, Request $request): Response
    {
        $factura_reserva = Array();
        $em = $this->getDoctrine()->getManager();
        $reserva = $em->getRepository(Reserva::class)->find($id);
        $factura_reserva = $em->getRepository(FacturaReserva::class)->findByReservaId($id);

        $consumicion_reserva = $em->getRepository(ConsumicionReserva::class)->findByReservaId($id);



        return $this->render('reserva/verFactura.html.twig', [
            'reserva' => $reserva,
            'factura_reserva' => $factura_reserva,
            'consumicion_reserva' => $consumicion_reserva
        ]);
    }

    /**
     * @Route("/reservas/crear/find-mesas-libres", options={"expose"=true}, name="find_mesas_libres_ajax")
     */
    public function findMesasLibresAjax(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $fecha = $request->request->get('fecha');
            $turno = $request->request->get('turno');
            $mesas_libres = $em->getRepository(Mesa::class)->findMesasLibres($fecha,$turno);
            return new JsonResponse(['mesas'=>$mesas_libres]);
        }else{
            throw new \Exception('No es una petición Ajax');
        }
    }
}

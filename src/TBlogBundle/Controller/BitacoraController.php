<?php

namespace TBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use TBlogBundle\Funciones\BitacoraFunciones;
use Symfony\Component\HttpFoundation\Response;

class BitacoraController extends Controller{

    /**
     * @Route("/Bitacora", name="Bitacora")
     */
    public function BitacoraAction(){
        return $this->render('TBlogBundle:Bitacora:Bitacora.html.twig');
    }

    /**
     * @Route("/LlenatablaBitacora", name="LlenatablaBitacora")
     */
    public function LlenatablaBitacoraAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $bitacora = new BitacoraFunciones();
            $params = array(
                'bitacoras' => $bitacora->GetBitacoraxnombre($nombre),
            );
        } else{
            $bitacora = new BitacoraFunciones();
            $params = array(
                'bitacoras' => $bitacora->GetBitacora(),
            );
        }
        $content = $this->render('TBlogBundle:Bitacora:TablaBitacora.html.twig', $params);
        return new Response($content);
    }


}
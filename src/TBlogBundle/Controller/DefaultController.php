<?php

namespace TBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use TBlogBundle\Funciones\DefaultFunciones;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller {

    /**
     * @Route("\" , name="Index")
     */
    public function IndexAction(Request $request){

        $fn = new DefaultFunciones();
        $articulos = [
            "articulos" => $fn ->LlenarArticulos()
        ];


        return $this->render('TBlogBundle:Default:index.html.twig', $articulos);
        
    }

   


    /**
     * @Route("/Login", name="Login")
     */
    //se bisca la funcion index
    public function LoginAction(Request $request){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //se verifica que los datos hayan sido enviados en el metodo post
            
            $usuario = $_POST['usuario'];
            $pass = $_POST['contrasena'];
            //se bajan los parametros y se asignan a una variable
            $fn = new DefaultFunciones();
            //se manda llamar al default funciones

            if($row = $fn->validausr($usuario, $pass)) {
               //$row recibe el valor de la consulta que se ejecuto en default funciones
                if($row['tipousr'] == "u"){
                    $session = $request->getSession();
                    //obtener los atributos de la session
                    $session->start();
                    //se inizializa la session
                    $this->get('session')->set('numco', $row['numco']);
                    //Se establece la variable de session que es utilizable en todo el proyecto
                    die("0");
                }
                if($row['tipousr'] == "a"){
                    $session = $request->getSession();
                    //obtener los atributos de la session
                    $session->start();
                    //se inizializa la session
                    $this->get('session')->set('numco', $row['numco']);
                    //Se establece la variable de session que es utilizable en todo el proyecto
                    die("1");
                }

                //es la respuesta que envia hacia ajax
            } else die("2");
        }
        return $this->render('TBlogBundle:Default:login.html.twig');
    }

    /**
     * @Route("/Registro", name="Registro")
     */
    
    //los datos que son necesarios para el registro
    public function RegistroAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $numcom = $_POST['numcon'];
            $correo = $_POST['mail'];
            $usuario = $_POST['usuario'];
            $pass = $_POST['contrasena'];
            $fn = new DefaultFunciones();
            if ($fn->Registrarusuario($numcom, $correo, $usuario, $pass)) die("1");
            else die("0");
        }
        return $this->render('TBlogBundle:Default:registro.html.twig');
    }

    /**
     * @Route("/Inicio", name="Inicio")
     */
    public function InicioAction(Request $request){
        $session = $request->getSession();
        if($session->has('numco')){
            $params = array(
                'mensaje' => 'Bienvenido al curso de symfony',
                'fecha' => date("d-m-y"),
                'alumno' => "Ivan Alberto Verde Martinez",
            );
            return $this->render('TBlogBundle:Default:inicio.html.twig', $params);
        } else return $this->render('TBlogBundle:Default:login.html.twig');
    }

    /**
     * @Route("/InicioA", name="InicioA")
     */
    public function InicioAAction(Request $request){
        $session = $request->getSession();
        if($session->has('numco')){
            $params = array(
                'mensaje' => 'Bienvenido al curso de symfony',
                'fecha' => date("d-m-y"),
                'alumno' => "Ivan Alberto Verde Martinez",
            );
            return $this->render('TBlogBundle:Default:inicioA.html.twig', $params);
        } else return $this->render('TBlogBundle:Default:login.html.twig');
    }

    /**
     * @Route("/Salir", name="Salir")
     */
    public function SalirAction(Request $request){
        $session = $request->getSession();
        //gestiona la session
        $session->invalidate();
        //Invalida la session o la finaliza
        return $this->render('TBlogBundle:Default:index.html.twig');
        //redirige al infdex
    }

}

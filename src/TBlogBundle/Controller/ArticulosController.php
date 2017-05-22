<?php


namespace TBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use TBlogBundle\Funciones\BitacoraFunciones;
use Symfony\Component\HttpFoundation\Response;
use TBlogBundle\Model\Model;

class ArticulosController extends Controller
{

    /**
     * @Route("/Articulos", name="Articulos")
     */
    public function ArticulosAction()
    {
        return $this->render('TBlogBundle:Articulos:Articulos.html.twig');
    }

    /**
     * @Route("/Importar", name="Importar")
     */
    public function ImportarAction(){
        $descripcion = $_POST['descripcion'];
        $idclasificaciones = $_POST['clasificacion'];

        $rutaactual = $this->get('Kernel')->getWebDir();
        $file =$_FILES;
        //print_r($file);
        $name = basename($file["archivo"]["name"]);
        $UploadsDir = $rutaactual."Resources/";
        $articulo = $UploadsDir.$name;


        if(file_exists($UploadsDir)){
            move_uploaded_file($file['archivo']['tmp_name'], "$UploadsDir/$name");

            //public function Articulo($articulo, $descripcion, $idclasificaciones){
                $conn = new Model();
                $sql = "insert into articulo (descripcion, imagen, idcla) values ('$descripcion', '$articulo', $idclasificaciones );";
                //$sql = "select * from articulo order by descripcion";
                $result = $conn->consulta($sql);
                $conn->close();
                die("1");
              //  return $result;
            //}
        }
        else{
            if(mkdir($UploadsDir, 0007, true)){
                move_uploaded_file($file['archivo']['tmp_name'], "$UploadsDir/$name");
                //print_r("Archivo cargado exitosamente.");
                $conn = new Model();
                $sql = "insert into articulo (descripcion, imagen, idcla) values ('$descripcion', '$articulo', $idclasificaciones );";
                $result = $conn->consulta($sql);
                $conn->close();
                die("1");
            }
            else{
                die("El archivo no se puede cargar. Error al cargar el directorio");
            }

        }
    }


    /**
     * @Route("/Descargar", name="Descargar")
     */
    public function DescargarAction(){
        $archivo = $_GET['articulo'];
        if (is_file($archivo)) {
            header('Content-Type: application/force-download');
            header('Content-Disposition: attachment; filename='.$archivo);
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: '.filesize($archivo));
            readfile($archivo);
        } else {
            die("No se encuentra el archivo");
        }
        
    }
}


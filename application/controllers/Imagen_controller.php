<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Imagen_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Imagen_model','imagenes');
	}

    public function nuevo_post() {
    	$datosPost = $this->post();
    	var_dump(FCPATH.'/uploads/');
    	$nombre_imagen = $datosPost['nombre_imagen'];
        $config['upload_path']          = FCPATH.'public/uploads/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_name']			= $nombre_imagen;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->response($error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            var_dump(base_url("system/uploads/".$data["upload_data"]["file_name"]));
            $datosImagen = array(
            	"idModeloVehiculo" => $datosPost['idModeloVehiculo'],
            	"idColor" => $datosPost['idColor'],
            	"imagen" => 'uploads/'.$data["upload_data"]["file_name"]
            );
            $result = $this->imagenes->insert($datosImagen);
            if (@$result['status'] === false)
	            $this->response($result);
	        else if ($result) {
	            $this->response(formatResponse($result));
	        } else {
	            $this->response(formatResponse(false, "No se encontraron resultados."));            
	        }
        }
    }

    public function obtenerImagenes_get() {
     	$datosBusqueda = array("idModeloVehiculo" => $this->get("idModeloVehiculo"),"idColor" => $this->get("idColor"));

        //var_dump(FCPATH);
        //var_dump(base_url("public/uploads/"));


        $result = $this->imagenes->getAll($datosBusqueda);
        if ($result) {
            $resultadoFinal["prefijoUrl"] = base_url("public/");
            $resultadoFinal["imagenes"] = $result;
            $this->response(formatResponse($resultadoFinal));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function eliminar_delete() {
       	$nombre_imagen = $this->delete('nombre_imagen');
        $ruta_imagen = FCPATH.'public/'.$nombre_imagen;
        var_dump($nombre_imagen);
       	unlink($ruta_imagen);

        $idImagen = $this->get('idImagen'); 
        $result = $this->imagenes->delete($idImagen);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Usuarios_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Usuarios_model','usuarios');
	}
 
    public function obtenerTodos_get() {
        $result = $this->usuarios->getAll();
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idUsuario = $this->get('idUsuario');	
        $result = $this->usuarios->getById($idUsuario);
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorSucursal_get() {
        $idSucursal = $this->get('idSucursal');	
        $result = $this->usuarios->getAllBySucursal($idSucursal);
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $usuario = $this->post();
        $requiredArray = ['nombre', 'apellidoPaterno', 'telefono', 'correo', 'direccion', 'idUsuarioCreador'];
        $validate = validateRequired($usuario,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->usuarios->insert($usuario);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idUsuario = $this->get('idUsuario');	
        $usuario = $this->put();
        $requiredArray = ['nombre', 'apellidoPaterno', 'telefono', 'correo', 'direccion', 'idUsuarioCreador'];
        $validate = validateRequired($usuario,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->usuarios->updateById($idUsuario, $usuario);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorId_delete() {
        $idUsuario = $this->get('idUsuario');	
        $result = $this->usuarios->deleteById($idUsuario);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorArray_delete() {
        $arrayIdUsuarios = $this->delete('idArray');	
        $result = $this->usuarios->deleteByArray($arrayIdUsuarios);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
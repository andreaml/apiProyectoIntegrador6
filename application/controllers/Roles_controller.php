<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Roles_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Roles_model','roles');
	}
 
    public function obtenerTodos_get() {
        $result = $this->roles->getAll();
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idRol = $this->get('idRol');	
        $result = $this->roles->getById($idRol);
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorNombre_get() {
        $rol = $this->get('rol');	
        $result = $this->roles->getByName($rol);
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $rol = $this->post();
        $requiredArray = ['rol','descripcion'];
        $validate = validateRequired($rol,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->roles->insert($rol);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idRol = $this->get('idRol');	
        $rol = $this->put();
        $requiredArray = ['rol','descripcion'];
        $validate = validateRequired($rol,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->roles->updateById($idRol, $rol);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorId_delete() {
        $idRol = $this->get('idRol');	
        $result = $this->roles->deleteById($idRol);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorArray_delete() {
        $arrayIdRoles = $this->delete('idArray');	
        $result = $this->roles->deleteByArray($arrayIdRoles);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
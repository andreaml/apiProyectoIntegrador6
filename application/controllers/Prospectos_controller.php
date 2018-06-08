<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Prospectos_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Prospectos_model','prospectos');
	}
 
    public function obtenerTodos_get() {
        $result = $this->prospectos->getAll();
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idProspecto = $this->get('idProspecto');	
        $result = $this->prospectos->getById($idProspecto);
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorVendedor_get() {
        $idVendedor = $this->get('idVendedor');	
        $result = $this->prospectos->getAllByUser($idVendedor);
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $prospecto = $this->post();
        $requiredArray = ['curp','nombre','apellidoPaterno','telefono','correo','direccion','idUsuarioCreador'];
        $validate = validateRequired($prospecto,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->prospectos->insert($prospecto);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idProspecto = $this->get('idProspecto');	
        $prospecto = $this->put();
        $requiredArray = ['curp','nombre','apellidoPaterno','telefono','correo','direccion','idUsuarioCreador'];
        $validate = validateRequired($prospecto,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->prospectos->updateById($idProspecto, $prospecto);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorId_delete() {
        $idProspecto = $this->get('idProspecto');	
        $result = $this->prospectos->deleteById($idProspecto);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorArray_delete() {
        $arrayIdProspectos = $this->delete('idArray');	
        $result = $this->prospectos->deleteByArray($arrayIdProspectos);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
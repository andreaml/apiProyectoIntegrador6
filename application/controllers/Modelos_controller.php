<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Modelos_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Modelos_model','modelos');
	}
 
    public function obtenerTodos_get() {
        $result = $this->modelos->getAll();
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idModeloVehiculo = $this->get('idModeloVehiculo');	
        $result = $this->modelos->getById($idModeloVehiculo);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorCategoria_get() {
        $categoria = $this->get('categoria');	
        $result = $this->modelos->getAllByCategory($categoria);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $sucursal = $this->post();
        $requiredArray = ['sucursal','telefono','direccion','tipo','ciudad','estado'];
        $validate = validateRequired($sucursal,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->sucursales->insert($sucursal);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idSucursal = $this->get('idSucursal');	
        $sucursal = $this->put();
        $requiredArray = ['sucursal','telefono','direccion','tipo','ciudad','estado'];
        $validate = validateRequired($sucursal,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->sucursales->updateById($idSucursal, $sucursal);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorId_delete() {
        $idSucursal = $this->get('idSucursal');	
        $result = $this->sucursales->deleteById($idSucursal);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorArray_delete() {
        $arrayIdSucursales = $this->delete('idArray');	
        $result = $this->sucursales->deleteByArray($arrayIdSucursales);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Stock_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Stock_model','stock');
	}
 
    public function obtenerTodos_get() {
        $result = $this->stock->getAll();
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorModelo_get() {
        $idModelo = $this->get('idModelo');	
        $result = $this->stock->getByModel($idModelo);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorIdSucursal_get() {
        $idSucursal = $this->get('idSucursal');	
        $estado = $this->get('estado');
        $result = $this->stock->getByIdSucursal($idSucursal,$estado);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idStock = $this->get('idStock');   
        $result = $this->stock->getById($idStock);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $stocks = $this->post();
        $requiredArray = ['estado','idSucursal','numeroSerie', 'idColor', 'idModelo'];
        $validate = validateRequired($stocks,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->stock->insert($stocks);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idVehiculo = $this->get('idVehiculo');	
        $vehiculo = $this->put();
        $requiredArray = ['idSucursal','numeroSerie', 'idColor'];
        $validate = validateRequired($vehiculo,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->stock->updateById ($idVehiculo, $vehiculo);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
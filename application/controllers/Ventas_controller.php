<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Ventas_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Ventas_model','ventas');
	}
 
    public function obtenerTodos_get() {
        $result = $this->ventas->getAll();
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idVenta = $this->get('idVenta');	
        $result = $this->ventas->getById($idVenta);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $venta = $this->post();
        $requiredArray = ['idVehiculo','fecha','hora','iva','total','estado','idRelClienteVendedor'];
        $validate = validateRequired($venta,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->ventas->insert($venta);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idVenta = $this->get('idVenta');	
        $venta = $this->put();
        $requiredArray = ['idVehiculo','fecha','hora','iva','total','estado','idRelClienteVendedor'];
        $validate = validateRequired($venta,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->ventas->updateById ($idVenta, $venta);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
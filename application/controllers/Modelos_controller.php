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

    public function publico_get() {
        $result = $this->modelos->compararExt();
        $this->response($result);
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
        $modelo = $this->post();
        $requiredArray = ['idCategoria','modelo','anio','version','tipoTransmision','aireAcondicionado','bolsasAire','tipoFreno','cilindrada','equipamiento','precio','numPuertas','numPasajeros','tipoCombustible','potencia','idUsuarioCreador'];
        $validate = validateRequired($modelo,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->modelos->insert($modelo);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idModeloVehiculo = $this->get('idModeloVehiculo');	
        $modelo = $this->put();
        $requiredArray = ['idCategoria','modelo','anio','version','tipoTransmision','aireAcondicionado','bolsasAire','tipoFreno','cilindrada','equipamiento','precio','numPuertas','numPasajeros','tipoCombustible','potencia','idUsuarioCreador'];
        $validate = validateRequired($modelo,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->modelos->updateById($idModeloVehiculo, $modelo);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
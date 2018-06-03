<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Seguimientos_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Seguimientos_model','seguimientos');
	}
 
    public function obtenerTodos_get() {
        $result = $this->seguimientos->getAll();
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idSeguimiento = $this->get('idSeguimiento');	
        $result = $this->seguimientos->getById($idSeguimiento);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $seguimiento = $this->post();
        $requiredArray = ['idRelClienteVendedor','fecha','horaInicio','horaFin','tipoSeguimiento'];
        $validate = validateRequired($seguimiento,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->seguimientos->insert($seguimiento);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idSeguimiento = $this->get('idSeguimiento');	
        $seguimiento = $this->put();
        $requiredArray = ['idRelClienteVendedor','fecha','horaInicio','horaFin','tipoSeguimiento'];
        $validate = validateRequired($seguimiento,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->seguimiento->updateById ($idSeguimiento, $seguimiento);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}

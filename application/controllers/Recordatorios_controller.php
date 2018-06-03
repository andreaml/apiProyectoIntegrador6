<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Recordatorios_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Recordatorios_model','recordatorios');
	}
 
    public function obtenerTodos_get() {
        $result = $this->recordatorios->getAll();
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idRecordatorio = $this->get('idRecordatorio');	
        $result = $this->recordatorios->getById($idRecordatorio);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $recordatorio = $this->post();
        $requiredArray = ['idRelClienteVendedor','fecha','hora','idSeguimiento','estado'];
        $validate = validateRequired($recordatorio,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->recordatorios->insert($recordatorio);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idRecordatorio = $this->get('idRecordatorio');	
        $recordatorio = $this->put();
        $requiredArray = ['idRelClienteVendedor','fecha','hora','idSeguimiento','estado'];
        $validate = validateRequired($recordatorio,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->recordatorios->updateById($idRecordatorio, $recordatorio);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function eliminarPorId_delete() {
        $idRecordatorio = $this->get('idRecordatorio'); 
        $result = $this->recordatorios->deleteById($idRecordatorio);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Envios_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Envios_model','envios');
	}
 
    public function obtenerTodos_get() {
        $result = $this->envios->getAll();
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idEnvio = $this->get('idEnvio');	
        $result = $this->envios->getById($idEnvio);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $envio = $this->post();
        $requiredArray = ['fechaEnvio','horaEnvio','fechaRecepcion','horaRecepcion','estado','idSolicitud'];
        $validate = validateRequired($envio,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->envios->insert($envio);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idEnvio = $this->get('idEnvio');	
        $envio = $this->put();
        $requiredArray = 'fechaEnvio','horaEnvio','fechaRecepcion','horaRecepcion','estado','idSolicitud';
        $validate = validateRequired($envio,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->envios->updateById ($idEnvio, $envio);
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
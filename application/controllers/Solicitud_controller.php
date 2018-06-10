<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Solicitud_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Solicitud_model','solicitudes');
	}
 
    public function obtenerPorSucursalSolicitada_get() {
        $idSucursalSolicitada = $this->get('idSucursalSolicitada');	
        $result = $this->solicitudes->getByRequestedBranch($idSucursalSolicitada);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorSucursalSolicitante_get() {
        $idSucursalSolicitante = $this->get('idSucursalSolicitante');	
        $result = $this->solicitudes->getByApplicantBranch($idSucursalSolicitante);
        if (@$result['status'] === false)
            $this->response($result);
        else if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $solicitud = $this->post();
        $requiredArray = ['idSucursalSolicitante','idSucursalSolicitada','fecha','hora','estado','idVehiculo'];
        $validate = validateRequired($solicitud,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->solicitudes->insert($solicitud);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idSolicitud = $this->get('idSolicitud');	
        $solicitud = $this->put();
        $requiredArray = ['idSucursalSolicitante','idSucursalSolicitada','fecha','hora','estado','idVehiculo'];
        $validate = validateRequired($solicitud,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->solicitudes->update($idSolicitud, $solicitud);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editarEstado_put() {
        $idSolicitud = $this->get('idSolicitud');	
        $solicitud = $this->put();
        $requiredArray = ['estado'];
        $validate = validateRequired($solicitud,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->solicitudes->update($idSolicitud, $solicitud);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
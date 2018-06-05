<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Clientes_controller extends REST_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model('Clientes_model','clientes');
	}
 
    public function obtenerTodos_get() {
        $result = $this->clientes->getAll();
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorId_get() {
        $idCliente = $this->get('idCliente');	
        $result = $this->clientes->getById($idCliente);
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function obtenerPorUsuarioCreador_get() {
        $idUsuarioCreador= $this->get('idUsuarioCreador');	
        $result = $this->clientes->getAllByUser($idUsuarioCreador);
        if ($result) {
            $this->response(formatResponse($result));
        } else {
            $this->response(formatResponse(false, "No se encontraron resultados."));            
        }
    }

    public function nuevo_post() {
        $cliente = $this->post();
        $requiredArray = ['curp','nombre','apellidoPaterno','apellidoMaterno','direccion','codigo_postal','RFC','sexo','telefono','celular','correo','ciudad','estado','prueba_manejo','idUsuarioCreador'];
        $validate = validateRequired($cliente,$requiredArray);
        if(!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->clientes->insert($cliente);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }

    public function editar_put() {
        $idCliente = $this->get('idCliente');	
        $cliente= $this->put();
        $requiredArray = ['nombre','apellidoPaterno','apellidoMaterno','direccion','codigo_postal','RFC','sexo','telefono','celular','correo','ciudad','estado','prueba_manejo','idUsuarioCreador'];
        $validate = validateRequired($cliente,$requiredArray);
        if (!@$validate['status'])
            $this->response(formatResponse(false,'Parámetros requeridos: '.implode(', ',$validate['error'])));
        $result = $this->clientes->updateById($idCliente, $cliente);
        if (@$result['status'] === false)
            $this->response($result);
        else
            $this->response(formatResponse($result));
    }
}
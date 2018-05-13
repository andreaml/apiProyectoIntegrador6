<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
 
class Test_Controller extends REST_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model('Clientes_model','clientes');
	}
 
    public function user_get()
    {
        $result = $this->clientes->obtenerClientes();
		$this->response($result);
    }
}
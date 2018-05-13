<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientes_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    function obtenerClientes(){
        $query = $this->db->get('clientes');
        return $query->result();
		// $sql = "SELECT * FROM clientes' ORDER BY nombre";
        // return getResult($sql);
	 }
    // public function guardar($c){
	// 	$id			= @$c['cliente_id']			!=''?	@$c['cliente_id'] 			:@$c['id'];
	// 	$nombre		= @$c['cliente_nombre']		!=''?	@$c['cliente_nombre'] 		:@$c['nombre'];
	// 	$domicilio	= @$c['cliente_domicilio']	!=''?	@$c['cliente_domicilio']	:@$c['domicilio'];
	// 	$colonia	= @$c['cliente_colonia']	!=''?	@$c['cliente_colonia'] 		:@$c['colonia'];
	// 	$ciudad		= @$c['cliente_ciudad']		!=''?	@$c['cliente_ciudad'] 		:@$c['ciudad'];
	// 	$cp			= @$c['cliente_cp']			!=''?	@$c['cliente_cp'] 			:@$c['codigoPostal'];
	// 	$rfc		= @$c['cliente_rfc']		!=''?	@$c['cliente_rfc'] 			:@$c['rfc'];
	// 	$telefono	= @$c['cliente_telefono']	!=''?	@$c['cliente_telefono'] 	:@$c['telefono'];
	// 	$celular	= @$c['cliente_celular']	!=''?	@$c['cliente_celular'] 		:@$c['celular'];
	// 	$correo		= @$c['cliente_correo']		!=''?	@$c['cliente_correo'] 		:@$c['correo'];
	// 	if($id){
	// 		$sql	= "UPDATE clientes SET nombre='$nombre',domicilio='$domicilio',codigoPostal=$cp,colonia='$colonia',ciudad=$ciudad,rfc='$rfc',telefono='$telefono',celular='$celular',correo='$correo'
	// 					WHERE id=$id";
	// 		myQuery($sql);
	// 		$result		= $id;
	// 	}else{
	// 		$sql 	= "INSERT INTO clientes (nombre,domicilio,codigoPostal,colonia,ciudad,rfc,telefono,celular,correo) 
	// 					VALUES ('$nombre','$domicilio',$cp,'$colonia',$ciudad,'$rfc','$telefono','$celular','$correo')";
	// 		$result		= myQuery($sql);
	// 	}
    //   	if($result)
	// 	    return $result;
    //     else
    //         return false;
	//  }
	// public function obtenerTodos(){
	// 	$sql = "SELECT * FROM clientes WHERE activo = 1";
	// 	return getResult($sql);
	//  }
	// public function obtenerClientebyId($idCliente){
	// 	$sql = "SELECT C.*, E.estado, Ci.municipio ciudad, E.id idEstado, Ci.id idMunicipio  FROM clientes C 
	// 				INNER JOIN ciudades Ci 	ON Ci.id = C.ciudad
	// 				INNER JOIN estados E 	ON Ci.estado = E.id 
	// 			WHERE C.id = $idCliente AND C.activo = 1";
	// 	return getResult($sql);
	//  }
	// public function eliminar($idCliente){
	// 	$sql = "UPDATE clientes C, vehiculos V 
	// 			SET C.activo = 0, V.activo = 0 
	// 			WHERE id = $idCliente";
	// 	return myQuery($sql);
	//  }
}

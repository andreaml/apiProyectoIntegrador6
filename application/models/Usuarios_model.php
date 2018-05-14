<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
		$this->db->trans_begin();
			$this->db->select('idTrabajador, nombre, apellidoPaterno, apellidoMaterno, telefono, correo, direccion, idUsuarioCreador');
			$this->db->from('usuarios');
			$this->db->where(['activo'=>1]);
			$query = $this->db->get(); 
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $query->result();
        }
	}

	public function getAllBySucursal($idSucursal){
		$this->db->trans_begin();
			$this->db->select('idTrabajador, nombre, apellidoPaterno, apellidoMaterno, telefono, correo, direccion, idUsuarioCreador');
			$this->db->from('usuarios');
			$this->db->join('rel_usuarios_sucursal', 'usuarios.idTrabajador = rel_usuarios_sucursal.idUsuario');
			$this->db->where(array('rel_usuarios_sucursal.idSucursal' => $idSucursal, 'usuarios.activo' => 1));
			$query = $this->db->get();

			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $query->result();
        }
	}

	public function getById($idUsuario) {
		$this->db->trans_begin();
			$this->db->select('idTrabajador, nombre, apellidoPaterno, apellidoMaterno, telefono, correo, direccion, idUsuarioCreador');
			$this->db->from('usuarios');
			$this->db->where(['idTrabajador'=>$idUsuario]);
			$query = $this->db->get(); 
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $query->result();
        }
	}

	private function checkIfClientIsInactive($correoUsuario) {
		$query = $this->db->get_where('usuarios', ['correo' => $correoUsuario, 'activo' => 0]);
		if ($query->result()) {
			return true;
		} else {
			return false;
		}
	}

	private function reactivateUser($usuario) {
		$usuario['activo'] = 1;
		$this->db->trans_begin();
			$query = $this->db->update('usuarios', $usuario, array('correo' => $usuario['correo']));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $usuario;
        }
	}

	public function insert($usuario) {
		$this->db->trans_begin();
			if ($this->checkIfClientIsInactive($usuario['correo']))
				return $this->reactivateUser($usuario);
			else {
				$query = $this->db->insert('usuarios', $usuario);
				if (!$query) {
					return formatDBErrorResponse($this->db->error());
				}
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $usuario;
        }
	}

	public function updateById($idUsuario, $usuario) {
		$this->db->trans_begin();
			$query = $this->db->update('usuarios', $usuario, array('idTrabajador' => $idUsuario));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $usuario;
        }
	}

	public function deleteById($idUsuario) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$query = $this->db->update('usuarios', $data, array('idTrabajador' => $idUsuario));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $idUsuario;
        }
	}

	public function deleteByArray($arrayIdUsuarios) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$this->db->where_in('idTrabajador', $arrayIdUsuarios);
			$query = $this->db->update('usuarios', $data);
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $arrayIdUsuarios;
        }
	}
}

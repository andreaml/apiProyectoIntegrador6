<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roles_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
		$this->db->trans_begin();
        	$query = $this->db->get_where('roles', ['activo'=>1]);
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

	public function getByName($rol){
		$this->db->trans_begin();
			$query = $this->db->get_where('roles', ['rol' => $rol]);
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

	public function getById($idRol) {
		$this->db->trans_begin();
			$query = $this->db->get_where('roles', ['idRol'=>$idRol]);
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

	private function checkIfRoleIsInactive($rol) {
		$query = $this->db->get_where('roles', ['rol' => $rol, 'activo' => 0]);
		if ($query->result()) {
			return true;
		} else {
			return false;
		}
	}

	private function reactivateRole($rol) {
		$rol['activo'] = 1;
		$this->db->trans_begin();
			$query = $this->db->update('roles', $rol, array('rol' => $rol['rol']));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $rol;
        }
	}

	public function insert($rol) {
		$this->db->trans_begin();
			if ($this->checkIfRoleIsInactive($rol['rol']))
				return $this->reactivateRole($rol);
			else {
				$query = $this->db->insert('roles', $rol);
				if (!$query) {
					return formatDBErrorResponse($this->db->error());
				}
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $rol;
        }
	}

	public function updateById($idRol, $rol) {
		$this->db->trans_begin();
			$query = $this->db->update('roles', $rol, array('idRol' => $idRol));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $rol;
        }
	}

	public function deleteById($idRol) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$query = $this->db->update('roles', $data, array('idRol' => $idRol));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $idRol;
        }
	}

	public function deleteByArray($arrayIdRoles) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$this->db->where_in('idRol', $arrayIdRoles);
			$query = $this->db->update('roles', $data);
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $arrayIdRoles;
        }
	}
}

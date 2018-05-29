<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sucursales_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
		$this->db->trans_begin();
			$query = $this->db->get('sucursales');
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

	public function getAllByCity($ciudad){
		$this->db->trans_begin();
			$query = $this->db->get_where('sucursales', ['ciudad' => $ciudad, 'activo' => 1]);
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

	public function getAllByState($estado){
		$this->db->trans_begin();
			$query = $this->db->get_where('sucursales', ['estado' => $estado, 'activo' => 1]);
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

	public function getById($idSucursal) {
		$this->db->trans_begin();
			$query = $this->db->get_where('sucursales', ['idSucursal' => $idSucursal]);
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

	private function checkIfSucursalIsInactive($idSucursal) {
		$query = $this->db->get_where('sucursales', ['telefono' => $idSucursal, 'activo' => 0]);
		if ($query->result()) {
			return true;
		} else {
			return false;
		}
	}

	private function reactivateSucursal($sucursal) {
		$sucursal['activo'] = 1;
		$this->db->trans_begin();
			$query = $this->db->update('sucursales', $sucursal, array('ciudad' => $sucursal['ciudad'], 'telefono' => $sucursal['telefono']));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $sucursal;
        }
	}

	public function insert($sucursal) {
		$this->db->trans_begin();
			if ($this->checkIfSucursalIsInactive($sucursal['telefono']))
				return $this->reactivateSucursal($sucursal);
			else {
				$query = $this->db->insert('sucursales', $sucursal);
				if (!$query) {
					return formatDBErrorResponse($this->db->error());
				}
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $sucursal;
        }
	}

	public function updateById($idSucursal, $sucursal) {
		$this->db->trans_begin();
			$query = $this->db->update('sucursales', $sucursal, array('idSucursal' => $idSucursal));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $sucursal;
        }
	}

	public function deleteById($idSucursal) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$query = $this->db->update('sucursales', $data, array('idSucursal' => $idSucursal));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $idSucursal;
        }
	}

	public function deleteByArray($arrayIdSucursales) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$this->db->where_in('idSucursal', $arrayIdSucursales);
			$query = $this->db->update('sucursales', $data);
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $arrayIdSucursales;
        }
	}
}

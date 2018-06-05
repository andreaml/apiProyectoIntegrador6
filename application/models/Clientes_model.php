<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientes_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
		$this->db->trans_begin();
        	$query = $this->db->get_where('clientes');
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

	public function getAllByUser($idUsuarioCreador){
		$this->db->trans_begin();

        	$this->db->select('*');
			$this->db->from('clientes');
			$this->db->where(array('idUsuarioCreador' => $idUsuarioCreador));
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

	public function getById($idCliente) {
		$this->db->trans_begin();
			$query = $this->db->get_where('clientes', ['curp'=>$idCliente]);
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

	private function checkIfProspectExists($idProspecto) {
		$query = $this->db->get_where('prospectos', ['curp' => $idProspecto, 'activo' => 0]);
		if ($query->result()) {
			return true;
		} else {
			return false;
		}
	}

	private function reactivateClient($prospecto) {
		$prospecto['activo'] = 1;
		$this->db->trans_begin();
			$query = $this->db->update('prospectos', $prospecto, array('curp' => $prospecto['curp']));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $prospecto;
        }
	}

	public function insert($cliente) {
        $this->db->trans_begin();
            
            $query = $this->db->insert('clientes', $cliente);
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
            
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $cliente;
        }
    }

	public function updateById($idCliente, $cliente) {
		$this->db->trans_begin();
			$query = $this->db->update('clientes', $cliente, array('curp' => $idCliente));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $cliente;
        }
	}

}

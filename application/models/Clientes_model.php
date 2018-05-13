<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientes_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
		$this->db->trans_begin();
        	$query = $this->db->get_where('clientes', ['activo'=>1]);
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

	public function getAllByUser($idUsuario){
		$this->db->trans_begin();

        	$this->db->select('*');
			$this->db->from('clientes');
			$this->db->join('rel_clientes_vendedor', 'clientes.curp = rel_clientes_vendedor.idCliente');
			$this->db->where(array('rel_clientes_vendedor.idUsuario' => $idUsuario, 'clientes.activo' => 1));
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

	private function checkIfClientIsInactive($idCliente) {
		$query = $this->db->get_where('clientes', ['curp' => $idCliente, 'activo' => 0]);
		if ($query->result()) {
			return true;
		} else {
			return false;
		}
	}

	private function reactivateClient($cliente) {
		$cliente['activo'] = 1;
		$this->db->trans_begin();
			$query = $this->db->update('clientes', $cliente, array('curp' => $cliente['curp']));
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

	public function insert($cliente) {
		$this->db->trans_begin();
			if ($this->checkIfClientIsInactive($cliente['curp']))
				return $this->reactivateClient($cliente);
			else {
				$query = $this->db->insert('clientes', $cliente);
				if (!$query) {
					return formatDBErrorResponse($this->db->error());
				}
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

	public function deleteById($idCliente) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$query = $this->db->update('clientes', $data, array('curp' => $idCliente));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $idCliente;
        }
	}

	public function deleteByArray($arrayIdClientes) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$this->db->where_in('curp', $arrayIdClientes);
			$query = $this->db->update('clientes', $data);
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $arrayIdClientes;
        }
	}
}

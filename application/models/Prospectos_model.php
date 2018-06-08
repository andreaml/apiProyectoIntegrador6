<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prospectos_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
		$this->db->trans_begin();
        	$query = $this->db->get_where('prospectos', ['activo'=>1]);
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
			$this->db->from('prospectos');
			$this->db->join('rel_prospectos_vendedor', 'prospectos.curp = rel_prospectos_vendedor.idCliente');
			$this->db->where(array('rel_prospectos_vendedor.idUsuario' => $idUsuario, 'prospectos.activo' => 1));
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

	public function getById($idProspecto) {
		$this->db->trans_begin();
			$query = $this->db->get_where('prospectos', ['curp'=>$idProspecto]);
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

	private function checkIfClientIsInactive($idProspecto) {
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

	public function insert($prospecto) {
		$this->db->trans_begin();
			if ($this->checkIfClientIsInactive($prospecto['curp']))
				return $this->reactivateClient($prospecto);
			else {
				$query = $this->db->insert('prospectos', $prospecto);
				if (!$query) {
					return formatDBErrorResponse($this->db->error());
				}
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $prospecto;
        }
	}

	public function updateById($idProspecto, $prospecto) {
		$this->db->trans_begin();
			$query = $this->db->update('prospectos', $prospecto, array('curp' => $idProspecto));
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

	public function deleteById($idProspecto) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$query = $this->db->update('prospectos', $data, array('curp' => $idProspecto));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $idProspecto;
        }
	}

	public function deleteByArray($arrayIdProspectos) {
		$data = ['activo' => 0];
		$this->db->trans_begin();
			$this->db->where_in('curp', $arrayIdProspectos);
			$query = $this->db->update('prospectos', $data);
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $arrayIdProspectos;
        }
	}
}

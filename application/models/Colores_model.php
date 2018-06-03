<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Colores_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
		$this->db->trans_begin();
			$query = $this->db->get('colores');
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

	public function getById($idColor) {
		$this->db->trans_begin();
			$query = $this->db->get_where('colores', ['idColor' => $idColor]);
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

	public function insert($color) {
		$this->db->trans_begin();
			
			$query = $this->db->insert('colores', $color);
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
			
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $color;
        }
	}

	public function updateById($idColor, $color) {
		$this->db->trans_begin();
			$query = $this->db->update('colores', $color, array('idColor' => $idColor));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $color;
        }
	}
}

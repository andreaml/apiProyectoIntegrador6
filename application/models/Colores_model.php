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

	public function getByModel($idModeloVehiculo) {
		$this->db->trans_begin();
			$query = $this->db->get_where('rel_modelo_color', ['idModeloVehiculo' => $idModeloVehiculo]);
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

	public function insertRelModeloColor($idModeloVehiculo, $idColor) {
		$data = array('idModeloVehiculo' => $idModeloVehiculo, 'idColor' => $idColor);
			
		$this->db->trans_begin();
			$query = $this->db->insert('rel_modelo_color', $data);
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
			
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $data;
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

	public function deleteByModel($idColor, $idModeloVehiculo) {
		$this->db->trans_begin();
			$query = $this->db->get_where('vehiculos', ['idModelo' => $idModeloVehiculo, 'idColor' => $idColor]);
			if (count($query->result()) > 0) {
				return formatDBErrorResponse(["message" => "No se puede eliminar un color ya asociado."]);
			} else {
				$query2 = $this->db->delete('rel_modelo_color', ['idModeloVehiculo' => $idModeloVehiculo, 'idColor' => $idColor]);
				if (!$query2) {
					return formatDBErrorResponse($this->db->error());
				}
			}
		$this->db->trans_complete();
		if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $data = array('idColor' => $idColor, 'idModeloVehiculo' => $idModeloVehiculo);
            return $data;
        }
	}
}

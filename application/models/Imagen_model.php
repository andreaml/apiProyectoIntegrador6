<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Imagen_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    
	public function insert($datosImagen) {
		$this->db->trans_begin();
			$query = $this->db->insert('imagenes', $datosImagen);
            $idImagen = $this->db->insert_id();			
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
			$this->db->trans_commit();
			$datosImagen['idImagen'] = $idImagen;
            return $datosImagen;
        }
	}

	public function getAll($datosBusqueda) {

		$this->db->trans_begin();
			
			$query = $this->db->get_where('imagenes', $datosBusqueda);

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

	public function delete($idImagen) {
		$this->db->trans_begin();
			$query = $this->db->delete('imagenes', array('idImagen' => $idImagen));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $idImagen;
        }
	}
}

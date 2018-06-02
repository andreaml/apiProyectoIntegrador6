<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ventas_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
        $this->db->trans_begin();
            $query = $this->db->get('ventas');
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

    public function getById($idVenta) {
        $this->db->trans_begin();
            $query = $this->db->get_where('ventas', ['idVenta' => $idVenta]);
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


    public function insert($venta) {
        $this->db->trans_begin();
            
            $query = $this->db->insert('ventas', $venta);
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
            
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $venta;
        }
    }

    public function updateById($idVenta, $venta) {
        $this->db->trans_begin();
            $query = $this->db->update('ventas', $venta, array('idVenta' => $idVenta));
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $venta;
        }
    }
}

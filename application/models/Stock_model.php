<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stock_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
        $this->db->trans_begin();
            $query = $this->db->get('stock');
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

    public function getById($idStock) {
        $this->db->trans_begin();
            $query = $this->db->get_where('stock', ['idStock' => $idStock]);
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

    public function getByIdSucursal($idSucursal,$estado) {
        $this->db->trans_begin();

            $this->db->select('ve.*, sto.idSucursal');
            $this->db->from('stock AS sto');
            $this->db->join('vehiculos AS ve', 'sto.idVehiculo= ve.idVehiculo');
            $this->db->where(array('sto.idSucursal' => $idSucursal, 'sto.estado' => $estado));
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


    public function insert($stocks) {
        $this->db->trans_begin();
            
            $query = $this->db->insert('stock', $stocks);
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
            
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $stocks;
        }
    }

    public function updateById($idStock, $stocks) {
        $this->db->trans_begin();
            $query = $this->db->update('stock', $stocks, array('idStock' => $idStock));
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $stocks;
        }
    }
}

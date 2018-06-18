<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stock_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
        $this->db->trans_begin();
            $this->db->select('v.idVehiculo, v.numeroSerie, v.idModelo, v.idColor, s.idSucursal, s.estado');
            $this->db->from('stock as s');
            $this->db->join('vehiculos as v', 'v.idVehiculo = s.idVehiculo');
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

    public function getById($idStock) {
        $this->db->trans_begin();
            $this->db->select('v.idVehiculo, v.numeroSerie, v.idModelo, v.idColor, s.idSucursal, s.estado');
            $this->db->from('stock as s');
            $this->db->join('vehiculos as v', 'v.idVehiculo = s.idVehiculo');
            $query = $this->db->where('idStock', $idStock);
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

    public function getByModel($idModelo) {
        $this->db->trans_begin();
            $this->db->select('v.idVehiculo,v.numeroSerie, v.idModelo, v.idColor, suc.idSucursal, suc.sucursal, s.estado');
            $this->db->from('vehiculos AS v');
            $this->db->join('stock AS s', 's.idVehiculo= v.idVehiculo');
            $this->db->join('sucursales AS suc', 's.idSucursal = suc.idSucursal');
            $this->db->where(array('v.idModelo' => $idModelo));
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

    public function getByIdSucursal($idSucursal,$estado) {
        $this->db->trans_begin();

            $this->db->select('v.numeroSerie, v.idModelo, v.idColor, s.idSucursal, s.estado');
            $this->db->from('stock AS s');
            $this->db->join('vehiculos AS v', 's.idVehiculo= v.idVehiculo');
            $this->db->where(array('s.idSucursal' => $idSucursal, 's.estado' => $estado));
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
            $vehiculo = [
                'idModelo' => $stocks['idModelo'],
                'numeroSerie' => $stocks['numeroSerie'],
                'idColor' => $stocks['idColor']
            ];
            $query = $this->db->insert('vehiculos', $vehiculo);
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
            $stock = [
                'estado' => $stocks['estado'],
                'idSucursal' => $stocks['idSucursal'],
                'idVehiculo' => $this->db->insert_id()
            ];
            $query2 = $this->db->insert('stock', $stock);
            if (!$query2) {
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

    public function updateById($idVehiculo, $vehiculo) {
        $this->db->trans_begin();
            $stocks = [
                "idSucursal" => $vehiculo["idSucursal"]
            ];
            $query = $this->db->update('stock', $stocks, array('idVehiculo' => $idVehiculo));
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
            $vehiculoNuevo = [
                "numeroSerie" => $vehiculo["numeroSerie"],
                "idColor" => $vehiculo["idColor"]
            ];
            $query2 = $this->db->update('vehiculos', $vehiculoNuevo, array('idVehiculo' => $idVehiculo));
            if (!$query2) {
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

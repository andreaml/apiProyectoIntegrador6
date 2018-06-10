<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Envios_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
        $this->db->trans_begin();
            $query = $this->db->get('envios');
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

    public function getById($idEnvio) {
        $this->db->trans_begin();
            $query = $this->db->get_where('envios', ['idEnvio' => $idEnvio]);
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


    public function insert($envio) {
        $this->db->trans_begin();
            
            $this->db->select('idSucursalSolicitante as idSucursal, idVehiculo');
            $this->db->where('idSolicitud', $envio['idSolicitud']);
            $solicitud = $this->db->get('solicitudes')->result();
            // var_dump($solicitud);
            // var_dump($solicitud[0]->idVehiculo);
            $idSucursal = $solicitud[0]->idSucursal;
            $idVehiculo = $solicitud[0]->idVehiculo;
            $this->db->where('idVehiculo', $idVehiculo);
            $updateStock = $this->db->update('stock', array('idSucursal' => $idSucursal));

            $query = $this->db->insert('envios', $envio);
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
            
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $envio;
        }
    }

    public function updateById($idEnvio, $envio) {
        $this->db->trans_begin();
            $query = $this->db->update('envios', $envio, array('idEnvio' => $idEnvio));
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $envio;
        }
    }
}

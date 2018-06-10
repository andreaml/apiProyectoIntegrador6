<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Solicitud_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getByRequestedBranch($idSucursalSolicitada){
        $this->db->trans_begin();
            $query = $this->db->get_where('solicitudes', ['idSucursalSolicitada' => $idSucursalSolicitada]);
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

    public function getByApplicantBranch($idSucursalSolicitante) {
        $this->db->trans_begin();
            $query = $this->db->get_where('solicitudes', ['idSucursalSolicitante' => $idSucursalSolicitante]);
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


    public function insert($solicitud) {
        $this->db->trans_begin();

            $query = $this->db->insert('solicitudes', $solicitud);
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
            
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $solicitud;
        }
    }

    public function update($idSolicitud, $solicitud) {
        $this->db->trans_begin();
            $query = $this->db->update('solicitudes', $solicitud, array('idSolicitud' => $idSolicitud));
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $solicitud;
        }
    }
}

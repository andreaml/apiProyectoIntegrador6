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

    public function deleteById($idRecordatorio) {
        $this->db->trans_begin();
            $query = $this->db->delete('recordatorios', array('idRecordatorio' => $idRecordatorio));
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $idRecordatorio;
        }
    }
}

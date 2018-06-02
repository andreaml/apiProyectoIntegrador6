<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recordatorios_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
        $this->db->trans_begin();
            $query = $this->db->get('recordatorios');
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


    public function getById($idRecordatorio) {
        $this->db->trans_begin();
            $query = $this->db->get_where('recordatorios', ['idRecordatorio' => $idRecordatorio]);
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


    public function insert($recordatorio) {
        $this->db->trans_begin();
            
            $query = $this->db->insert('recordatorios', $recordatorio);
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
            
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $recordatorio;
        }
    }

    public function updateById($idRecordatorio, $recordatorio) {
        $this->db->trans_begin();
            $query = $this->db->update('recordatorios', $recordatorio, array('idRecordatorio' => $idRecordatorio));
            if (!$query) {
                return formatDBErrorResponse($this->db->error());
            }
        $this->db->trans_complete();
        
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $recordatorio;
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

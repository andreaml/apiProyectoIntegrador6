<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Modelos_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function getAll(){
		$this->db->trans_begin();
			$query = $this->db->get('modelos_vehiculos');
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

	public function getAllByCategory($categoria){
		$this->db->trans_begin();
			$query = $this->db->get_where('modelos_vehiculos', ['idCategoria' => $categoria]);
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

	public function getById($idModeloVehiculo) {
		$this->db->trans_begin();
			$query = $this->db->get_where('modelos_vehiculos', ['idModeloVehiculo' => $idModeloVehiculo]);
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

	public function compararExt() {
		$this->load->model("Imagen_model", "ImagenesModel");
		$modelos = $this->db->query("SELECT DISTINCT modelo AS nombre FROM modelos_vehiculos")->result();
		$retModelos = [];
		foreach($modelos as $modelo) {
			$modelo->variantes = [];
			$variantes = $this->db->query("SELECT anio, version, tipoTransmision, potencia, precio FROM modelos_vehiculos WHERE modelo = \"{$modelo->nombre}\"")->result();
			foreach($variantes as $variante) {
				$varianteModelo = new stdClass();
				$varianteModelo->nombre = $variante->version . " - " . $variante->anio;
				$varianteModelo->precio = $variante->precio;

				$caracteristicas = new stdClass();
				$caracteristicas->potencia = $variante->potencia;
				$caracteristicas->transmision = $variante->tipoTransmision;

				$varianteModelo->caracteristicas = $caracteristicas;

				$modelo->variantes[] = $varianteModelo;
			}
			$retModelos[] = $modelo;
		}
		return $retModelos;
	}

	private function checkIfSucursalIsInactive($idSucursal) {
		$query = $this->db->get_where('modelos_vehiculos', ['telefono' => $idSucursal, 'activo' => 0]);
		if ($query->result()) {
			return true;
		} else {
			return false;
		}
	}

	private function reactivateSucursal($sucursal) {
		$sucursal['activo'] = 1;
		$this->db->trans_begin();
			$query = $this->db->update('modelos_vehiculos', $sucursal, array('ciudad' => $sucursal['ciudad'], 'telefono' => $sucursal['telefono']));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $sucursal;
        }
	}

	public function insert($modelo) {
		$this->db->trans_begin();
			
			$query = $this->db->insert('modelos_vehiculos', $modelo);
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
			
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $modelo;
        }
	}

	public function updateById($idModeloVehiculo, $modelo) {
		$this->db->trans_begin();
			$query = $this->db->update('modelos_vehiculos', $modelo, array('idModeloVehiculo' => $idModeloVehiculo));
			if (!$query) {
				return formatDBErrorResponse($this->db->error());
			}
		$this->db->trans_complete();
		
        if ($this->db->trans_status()===false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $modelo;
        }
	}
}

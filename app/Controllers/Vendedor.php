<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DominioVehiculoModel;
use App\Models\EstadiaModel;
use App\Models\MarcaModel;
use App\Models\ZonaModel;


class Vendedor extends BaseController
{
    //funcionalidad del vendedor
     public function verVenderEstadiaListadoVehiculo()
     {
         if (!$this->esVendedor()) {
             return redirect()->to(base_url());
         }
 
         $userModel = new UserModel();
         $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $dominioModel = new DominioVehiculoModel();
        $data['dominio_vehiculos'] = $dominioModel->obtenerTodos();

        
 
        //dd($data);
         return view('viewVendedor/viewMasterListadoVehiculos', $data);
     }

     public function verVenderEstadia($id_dominio)
     {
        if (!$this->esVendedor()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $marcaModel = new MarcaModel();
        $data['marcas'] = $marcaModel->findAll();

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));

        $dominioModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioModel->obtenerPorId($id_dominio);

        $zonaModel = new ZonaModel();
        $data['zonas'] = $zonaModel->findAll();

        //dd($data);
        return view('viewVendedor/viewMasterVender', $data);

     }

     public function verListadoVentas()
     {
        if (!$this->esVendedor()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        return view('viewVendedor/viewMasterListadoVentas', $data);
     }
     
     private function esVendedor()
    {
        if (session('rol') === '2') {
            return true;
        }
        return false;
    }
}
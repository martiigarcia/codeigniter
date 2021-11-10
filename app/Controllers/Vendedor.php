<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DominioVehiculoModel;


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

      
        $data['dominio'] = $id_dominio;

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
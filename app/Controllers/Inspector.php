<?php

namespace App\Controllers;

use App\Models\EstadiaModel;
use App\Models\UserModel;

use DateTime;

class Inspector extends BaseController
{
    //funcionalidad del inspector
    public function verConsultaEstacionamiento()
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        
        //dd($data);

        $data['estadias'] = $estadiaModel->obtenerTodas();

        return view('viewInspector/viewMasterConsultarEstacionamiento', $data);
    }

    public function verDetalleEstacionamiento($id)
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        
        //dd($data);

        $data['estadia'] = $estadiaModel->obtenerEstadiaById($id);

        return view('viewInspector/viewMasterDetalleEstacionamiento', $data);
    }

    private function esInspector()
    {
        if (session('rol') === '3') {
            return true;
        }
        return false;
    }
}
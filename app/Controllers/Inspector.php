<?php

namespace App\Controllers;

use App\Models\EstadiaModel;
use App\Models\InfraccionModel;
use App\Models\UserModel;
use App\Models\ZonaModel;
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
        if ((!$this->esInspector())) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();

        //dd($data);

        $data['estadiaSeleccionada'] = $estadiaModel->obtenerEstadiaById($id);

        return view('detalleEstacionamiento', $data);
    }

    public function verRegistrarInfraccion()
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $zonaModel = new ZonaModel();


        $data['zonas'] = $zonaModel->findAll();

        return view('viewInspector/viewMasterRegistrarInfraccion', $data);
    }

    public function registrarInfraccion()
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $validacion = $this->validate([
            'calle' => 'required',
            'altura' => 'required'
        ]);

        if ($validacion) {

            $infraccionModel = new InfraccionModel();
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechaInicio = (new DateTime())->format('Y-m-d H:i:s');
            $data = [
                'dia_hora' => $fechaInicio,
                'calle' => $_POST['calle'],
                'altura' => $_POST['altura'],
                'id_estadia' => 106
            ];
            $infraccionModel->save($data);
            session()->setFlashdata('mensaje', 'La infraccion se registro exitosamente');
            return redirect()->to(base_url('/home'));

        } else {

            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()
                ->back()
                ->withInput();

        }


    }

    public function obtenerHistoralZona($idZona)
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $historalZonaModel = new HistorialZonaModel();
        return json_encode($historalZonaModel->obtenerZonas($idZona));

    }

    private function esInspector()
    {
        if (session('rol') === '3') {
            return true;
        }
        return false;
    }

}
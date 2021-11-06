<?php

namespace App\Controllers;

use App\Models\UserModel;

class Vehiculos extends BaseController
{

    public function verRegistroVehiculo()
    {
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));
        return view('viewCliente/viewMasterRegistrarVehiculo', $data);
    }

    public function registrarVehiculo()
    {
        echo("entra");
    }

    public function verEstacionar()
    {
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));
        return view('viewCliente/viewMasterEstacionar', $data);
    }

    public function estacionar()
    {
        echo("estacionar  ");
        if(empty($_POST['cantidad_horas'])){
            echo("indefinida  ");
        }else{
            echo("definida  ");
        }

        //verificar si se ingreso a la opcion de pago o no-> se puede hacer con un cartel emergente del template
        
    }

    public function verDesEstacionar()
    {
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));
        return view('viewCliente/viewMasterDesEstacionar', $data);
    }

    public function desEstacionar()
    {
        echo("desestacionar");
    }


    



}
<?php

namespace App\Controllers;

use App\Models\EstadiaModel;
use App\Models\MarcaModel;
use App\Models\ModeloModel;
use App\Models\UserModel;
use App\Models\VehiculoModel;
use App\Models\DominioVehiculoModel;

class Cliente extends BaseController
{

    public function verRegistroVehiculo()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $marcaModel = new MarcaModel();
        $data['marcas'] = $marcaModel->findAll();

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadias();
        //dd($data);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVegiculos();
        
        return view('viewCliente/viewMasterRegistrarVehiculo', $data);
    }

    public function obtenerModelosPorMarca($id)
    {
        $modeloModel = new ModeloModel();
        return json_encode($modeloModel->obtenerModelosPorMarcas($id));
    }

    public function registrarVehiculo()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $validacion = $this->validate([
            'patente' => 'required',
            'marca' => 'required',
            'modelo' => 'required',

        ]);
        if ($validacion) {
            $vehiculoModel = new VehiculoModel();
            $dominiVehiculoModel = new DominioVehiculoModel();
            $data = $vehiculoModel->obtenerPorPatente($_POST['patente']);

            

            //comprobar si el vehiculo ya existe
            if (!empty($data)) {
                //si existe comprobar que sean todos sus campos iguales
                if (($data->modelo === $_POST['modelo']) && ($data->marca === $_POST['marca'])) {
                    //comprobar si el vehiculo ya esta asociado al cliente
                    if (empty($dominiVehiculoModel->obtenerPorUsuario(session('id'), $data->id))) {
                        $dominioData = [
                            'id_usuario' => session('id'),
                            'id_vehiculo' => $data->id
                        ];

                        dd($data);

                        $dominiVehiculoModel->save($dominioData);
                        return redirect()->to(base_url('/home'));
                    } else {
                        return redirect()->back()->with('mensaje', 'Usted ya tiene registrado este vehiculo')
                            ->withInput();
                    }

                } else {
                    return redirect()->back()->with('mensaje', 'Ya existe un vehiculo con esta Patente, pero con Marca y Modelo diferentes')
                        ->withInput();
                }
            } else {

                $vehiculoModel->save($_POST);
                //volver a buscar el vehiculo para optener el id
                $data = $vehiculoModel->obtenerPorPatente($_POST['patente']);
               
                $dominioData = [
                    'id_usuario' => session('id'),
                    'id_vehiculo' => $data->id
                ];

                dd($dominioData);

                $dominiVehiculoModel->save($dominioData);
                session()->setFlashdata('mensaje', 'Los datos se guardaron con exito');
                return redirect()->to(base_url('/home'));
            }
        } else {
            $error = $this->validator->listErrors();
            session()->setFlashdata('mensaje', $error);
            return redirect()->back()->with('mensaje', 'Debe completar los campos correctamente')
                ->withInput();

        }

    }

    public function verEstacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadias();
        //dd($data);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVegiculos();

        return view('viewCliente/viewMasterEstacionar', $data);
    }

    public function estacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        echo("estacionar  ");
        if (empty($_POST['cantidad_horas'])) {
            echo("indefinida  ");
        } else {
            echo("definida  ");
        }

        //verificar si se ingreso a la opcion de pago o no-> se puede hacer con un cartel emergente del template

    }

    public function verDesEstacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));
        
        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadias();
        //dd($data);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVegiculos();

        return view('viewCliente/viewMasterDesEstacionar', $data);
    }

    public function desEstacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        echo("desestacionar");
    }

    public function verPagarEstadiasPendientes()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadias();
        //dd($data);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVegiculos();

        return view('viewCliente/viewMasterPagarEstadiasPendientes', $data);
    }

    public function PagarEstadiasPendientes()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        echo("pagar estadia");
    }


    //funcionalidad del adminsitrador
    public function verListadoVehiculosEstacionados()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadias();
        //dd($data);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVegiculos();

        return view('viewAdministrador/viewMasterListadoVehiculosEstacionados', $data);
    }

    private function esCliente()
    {
        if (session('rol') === '4') {
            return true;
        }
        return false;
    }


}
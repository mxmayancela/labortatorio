<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarrierRequest;
use App\Models\Carrier;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarrierController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $carriers = Carrier::with('person')->get();
            return $this->responseTo(
                success: true,
                data: $carriers,
                status: 200,
                message: 'Se ha obtenido los transportistas correctamente Retornando la información',
                typeMessage: 'success'
            );
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function store(CarrierRequest $request)
    {
        try {

            $person = new Person();
            $person->name = $request->name;
            $person->lastnamefather = $request->lastnamefather;
            $person->lastnamemother = $request->lastnamemother;
            $person->cedula = $request->cedula;
            $person->birthdate = $request->birthdate;
            if ( $person->save()) {
                $carrier = new Carrier();
                $carrier->license = $request->license;
                $carrier->id_person = $person->id;
                $carrier->save();
            }

            return $this->responseTo(
                success: true,
                data: $carrier,
                status: 201,
                message: 'Se ha creado el transportista correctamente',
                typeMessage: 'success'
            );
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function show($id)
    {
        try {
            $carrier = Carrier::with('person')->find($id);
            if ($carrier) {
                return $this->responseTo(
                    success: true,
                    data: $carrier,
                    status: 200,
                    message: 'Se ha obtenido el transportista correctamente',
                    typeMessage: 'success'
                );
            } else {
                return $this->responseTo(
                    success: false,
                    data: null,
                    status: 404,
                    message: 'No se ha encontrado el transportista',
                    typeMessage: 'warning'
                );
            }
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function update(CarrierRequest $request, $id)
    {
        try {
            $carrier = Carrier::find($id);
            if ($carrier) {
                $person = Person::find($carrier->id_person);
                $person->fill($request->all());
                if ($person->save()) {
                    $carrier->license = $request->input('license');
                    $carrier->save();
                }
                return $this->responseTo(
                    success: true,
                    data: $carrier->load('person'),
                    status: 200,
                    message: 'Se ha actualizado el transportista correctamente',
                    typeMessage: 'success'
                );
            } else {
                return $this->responseTo(
                    success: false,
                    data: null,
                    status: 404,
                    message: 'No se ha encontrado el transportista',
                    typeMessage: 'warning'
                );
            }
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function destroy($id)
    {
        try {
            $carrier = Carrier::find($id);
            if ($carrier) {
                $person = Person::find($carrier->id_person);
                $person->delete();
                $carrier->delete();
                return $this->responseTo(
                    success: true,
                    data: $carrier,
                    status: 200,
                    message: 'Se ha eliminado el transportista correctamente',
                    typeMessage: 'success'
                );
            } else {
                return $this->responseTo(
                    success: false,
                    data: null,
                    status: 404,
                    message: 'No se ha encontrado el transportista',
                    typeMessage: 'warning'
                );
            }
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function test()
    {
        $test=Carrier::with('person')->get();
        return $this->responseTo(
            success: true,
            data: null,
            status: 200,
            message: 'Se ha obtenido los transportistas correctamente Retornando la información',
            typeMessage: 'success'
        );
    }
}

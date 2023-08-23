<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use App\Http\Requests\BusRequest;

class BusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $bus= Bus::with('carrier.person')->get();
            return $this->responseTo(
                success: true,
                data: $bus,
                status: 200,
                message: 'Se ha obtenido los buses correctamente',
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

    public function store(BusRequest $request)
    {
        try {
            $bus = new Bus();
            $bus->unitnumber = $request->unitnumber;
            $bus->licenseplate = $request->licenseplate;
            $bus->model = $request->model;
            $bus->capacity = $request->capacity;
            $bus->year = $request->year;
            $bus->id_carrier = $request->id_carrier;
            $bus->save();

            return $this->responseTo(
                success: true,
                data: $bus,
                status: 200,
                message: 'Se ha creado el bus correctamente',
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

    public function show($id)
    {
        try {
            $bus = Bus::with('carrier')->find($id);
            if ($bus) {
                return $this->responseTo(
                    success: true,
                    data: $bus,
                    status: 200,
                    message: 'Se ha obtenido el bus correctamente',
                    typeMessage: 'success'
                );
            } else {
                return $this->responseTo(
                    success: false,
                    data: null,
                    status: 404,
                    message: 'No se ha encontrado el bus',
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

    public function update(Request $request, $id)
    {
        try {
            $bus = Bus::find($id);
            if ($bus) {
                $bus->unitnumber = $request->unitnumber;
                $bus->licenseplate = $request->licenseplate;
                $bus->model = $request->model;
                $bus->capacity = $request->capacity;
                $bus->year = $request->year;
                $bus->id_carrier = $request->id_carrier;
                $bus->save();
                return $this->responseTo(
                    success: true,
                    data: $bus,
                    status: 200,
                    message: 'Se ha actualizado el bus correctamente',
                    typeMessage: 'success'
                );
            } else {
                return $this->responseTo(
                    success: false,
                    data: null,
                    status: 404,
                    message: 'No se ha encontrado el bus',
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

    public function destroy($id_bus)
    {
        try {
            $bus = Bus::find($id_bus);
            if ($bus) {
                $bus->delete();
                return $this->responseTo(
                    success: true,
                    data: $bus,
                    status: 200,
                    message: 'Se ha eliminado el bus correctamente',
                    typeMessage: 'success'
                );
            } else {
                return $this->responseTo(
                    success: false,
                    data: null,
                    status: 404,
                    message: 'No se ha encontrado el bus',
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


}

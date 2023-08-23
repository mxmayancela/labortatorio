<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $citys = City::with('province')->orderBy("cityname","asc")->get();
            return $this->responseTo(
                success: true,
                data: $citys,
                status: 200,
                message: 'Se ha obtenido las ciudades correctamente',
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

    public function store(Request $request)
    {
        try {
            $city = new City();
            $city->cityname = $request->cityname;
            $city->id_province = $request->id_province;
            $city->save();

            return $this->responseTo(
                success: true,
                data: $city,
                status: 200,
                message: 'Se ha creado la ciudad correctamente',
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

    public function update(Request $request, $id)
    {
        try {
            $city = City::find($id);
            $city->cityname = $request->cityname;
            $city->id_province = $request->id_province;
            $city->save();

            return $this->responseTo(
                success: true,
                data: $city,
                status: 200,
                message: 'Se ha actualizado la ciudad correctamente',
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

    public function destroy($id)
    {
        try {
            $city = City::find($id);
            $city->delete();

            return $this->responseTo(
                success: true,
                data: $city,
                status: 200,
                message: 'Se ha eliminado la ciudad correctamente',
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
}

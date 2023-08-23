<?php

namespace App\Http\Controllers;

use App\Clases\RouteClass;
use App\Http\Requests\RouteRequest;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $routes = Route::with('city_origin.province', 'city_destination.province', 'bus.carrier.person')->get();
            return $this->responseTo(
                success: true,
                data: $routes,
                status: 200,
                message: 'Se ha obtenido las rutas correctamente',
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

    public function store(RouteRequest $request)
    {
        try {
            $carrierFree=new RouteClass();
            if($carrierFree->execute($request->id_bus)['success']){
                return $this->responseTo(
                    success: false,
                    data: $carrierFree->execute($request->id_bus)['data'],
                    status: 200,
                    message: $carrierFree->execute($request->id_bus)['message'],
                    typeMessage: 'warning'
                );
            }

            $route = new Route();
            $route->id_city_origin = $request->id_city_origin;
            $route->id_city_destination = $request->id_city_destination;
            $route->id_bus = $request->id_bus;
            $route->date=$request->date;
            $route->start_time=$request->start_time;
            $route->end_time=$request->end_time;
            $route->date_end=$request->date_end;
            $route->complete=false;
            if($route->save()){
                $carrierFree->updateEnableCarrier($request->id_bus);
            }
            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Se ha creado la ruta correctamente',
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
            $route = Route::with('city_origin', 'city_destination', 'bus.carrier.person')->find($id);
            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Se ha obtenido la ruta correctamente',
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
            $route = Route::find($id);
            $route->id_city_origin = $request->id_city_origin;
            $route->id_city_destination = $request->id_city_destination;
            $route->id_bus = $request->id_bus;
            $route->date=$request->date;
            $route->start_time=$request->start_time;
            $route->end_time=$request->end_time;
            $route->date_end=$request->date_end;
            $route->save();

            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Se ha actualizado la ruta correctamente',
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
            $route = Route::find($id);
            $route->delete();

            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Se ha eliminado la ruta correctamente',
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

    public function updateComplete($id, Request $request){
        try {
            $route = Route::find($id);
            $route->complete=true;
            $route->save();

            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Estado de ruta actualizado correctamente',
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

    public function incompleteRoute(){
        try {
            $routes = Route::with('city_origin.province', 'city_destination.province', 'bus.carrier.person')->where('complete',false)->get();
            return $this->responseTo(
                success: true,
                data: $routes,
                status: 200,
                message: 'Se ha obtenido las rutas correctamente',
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

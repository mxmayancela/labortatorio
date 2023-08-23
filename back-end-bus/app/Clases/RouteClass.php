<?php
namespace App\Clases;
use Illuminate\Support\Facades\DB;

class RouteClass{


    public function execute(int $idBus){
        $result=[];
        $result['success']=false;
        $result['message']='';
        $result['data']=null;
        if($this->validateOneBusRoute($idBus)){
            $result['success']=true;
            $result['message']='El bus ya tiene una ruta activa';
            $result['data']=null;
        }
        return $result;
    }

    private function validateOneBusRoute($idBus){
        return DB::table('routes')->where('id_bus', $idBus)->where('complete', false)->exists();
    }

    private function validateCarrierEnable($idBus){
        return  DB::table('carriers')
        ->join('bus', 'carriers.id', '=', 'bus.id_carrier')
        ->where('bus.id', $idBus)->exists();
    }
    public function updateEnableCarrier($idBus) {
        DB::table('carriers')
            ->join('bus', 'carriers.id', '=', 'bus.id_carrier')
            ->where('bus.id', $idBus)
            ->update(['carriers.enable' => false]);
    }
    

}
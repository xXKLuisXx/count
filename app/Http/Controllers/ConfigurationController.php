<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Counter;
use App\Models\Provider;
use App\Models\Staff;

use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveData(Request $request)
    {
        $config = Configuration::where('id', 1)->first();
        $config->aforo = $request->aforo;
        $config->save();

        $response = array('status' => 'success', 'mensaje' => 'Información actualizada');

        return response()->json($response);
    }

    public function newDia()
    {
        Staff::where('dentro', 1)->update(['dentro' => 0]);
        Counter::where('contabilizado', 0)->update(['contabilizado' => 1]);
        $response = array('status' => 'success', 'mensaje' => 'Nuevo día iniciado con éxito, contadores y boletos reestablecidos ');

        return response()->json($response);
    }

    public function importarData(Request $request)
    {
        foreach ($request->provider as $p => $proveedor) {
            $prov = Provider::where('provider_id', $proveedor['provider_id'])->first();
            if ($prov == null) {
                $provi = new Provider();

                $provi->provider_id = $proveedor['provider_id'];
                $provi->limite_dentro = $proveedor['max_quantity_staff'];

                $provi->save();
            } else {
                $prov->limite_dentro = $proveedor['max_quantity_staff'];
                $prov->save();
            }
        }
        foreach ($request->staff as $s => $staff) {
            $st = Staff::where('provider_id', $staff['provider_id'])->where('folio', $staff['folio'])->first();
            if ($st == null) {
                $sstt = new Staff();

                $sstt->provider_id = $staff['provider_id'];
                $sstt->folio = $staff['folio'];

                $sstt->save();
            }
        }

        $response = array('status' => 'success', 'mensaje' => 'Información de staff actualizada ');

        return response()->json($response);
    }
}

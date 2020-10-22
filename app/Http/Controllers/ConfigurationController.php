<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Counter;
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

    public function newDia(){
        Staff::where('dentro', 1)->update(['dentro' => 0]);
        Counter::where('contabilizado', 0)->update(['contabilizado' => 1]);
        $response = array('status' => 'success', 'mensaje' => 'Nuevo día iniciado con éxito, contadores y boletos reestablecidos ');

        return response()->json($response);
    }
}

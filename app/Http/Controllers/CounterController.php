<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Counter;
use App\Models\Staff;
use App\Models\Provider;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function contadores()
    {
        $aforo = Configuration::where('id', 1)->first();
        if ($aforo == null) {
            $config = new Configuration();
            $config->id = 1;
            $config->aforo = 1510;
            $config->save();

            $aforo = Configuration::where('id', 1)->first();
        }
        $free = $aforo->aforo - Counter::where('contabilizado', false)->sum('count');
        $counter = Counter::where('contabilizado', false)->sum('count');
        $response = array("free" => $free, "counter" => $counter, "aforoTotal" => $aforo->aforo );
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->token != null) {
            $aforo = Configuration::where('id', 1)->first();
            if ($aforo == null) {
                $config = new Configuration();
                $config->id = 1;
                $config->aforo = 1510;
                $config->save();

                $aforo = Configuration::where('id', 1)->first();
            }
            $bandera = false;

            if ($request->input('count') > 0) {
                $status_ingreso = 1;
                $mensaje_entrada_salida = 'Entrada verificada con éxito';
            } else {
                $status_ingreso = 0;
                $mensaje_entrada_salida = 'Salida verificada con éxito';
            }

            if ($request->token == 'INGRESOEXPOESPACIO15') {
                $bandera = true;
            } else {
                if (Counter::where('contabilizado', false)->sum('count') < $aforo->aforo || !$status_ingreso) {
                    $respuestaStaff = $this->validarStaff($request->token, $status_ingreso);
                    if ($respuestaStaff['valido']) {
                        $bandera = true;
                    } else {
                        $free = $aforo->aforo - Counter::where('contabilizado', false)->sum('count');
                        $counter = Counter::where('contabilizado', false)->sum('count');
                        $response = array("free" => $free, "counter" => $counter, 'status' => 'error', 'mensaje' => $respuestaStaff['mensaje'], "aforoTotal" => $aforo->aforo );

                        return response()->json($response);
                    }
                } else {
                    $free = $aforo->aforo - Counter::where('contabilizado', false)->sum('count');
                    $counter = Counter::where('contabilizado', false)->sum('count');
                    $response = array("free" => $free, "counter" => $counter, 'status' => 'error', 'mensaje' => 'Entrada no verificada, cupo lleno', "aforoTotal" => $aforo->aforo );

                    return response()->json($response);
                }
            }

            if ($bandera) {
                if ($request->input('count') > 0) {
                    if (Counter::where('contabilizado', false)->sum('count') < $aforo->aforo || !$status_ingreso) {
                        $counterObj = new Counter();

                        $counterObj->token = $request->token;
                        $counterObj->count = $request->input('count');

                        $counterObj->save();
                    } else {
                        $free = $aforo->aforo - Counter::where('contabilizado', false)->sum('count');
                        $counter = Counter::where('contabilizado', false)->sum('count');
                        $response = array("free" => $free, "counter" => $counter, 'status' => 'error', 'mensaje' => 'Entrada no verificada, cupo lleno', "aforoTotal" => $aforo->aforo );

                        return response()->json($response);
                    }
                } else {
                    if (Counter::where('contabilizado', false)->sum('count') > 0) {
                        $counterObj = new Counter();

                        $counterObj->token = $request->token;
                        $counterObj->count = $request->input('count');

                        $counterObj->save();
                    }
                }
            }
        }
        $free = $aforo->aforo - Counter::where('contabilizado', false)->sum('count');
        $counter = Counter::where('contabilizado', false)->sum('count');
        $response = array("free" => $free, "counter" => $counter, 'status' => 'success', 'mensaje' => $mensaje_entrada_salida, "aforoTotal" => $aforo->aforo );
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function edit(Counter $counter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Counter $counter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        //
    }

    public function validarStaff($token, $status_ingreso)
    {
        $respuestaStaff = array();
        $staff = Staff::where('folio', $token)->first();
        if ($staff == null) {
            $respuestaStaff['mensaje'] = 'QR no registrado ';
            $respuestaStaff['valido'] = false;

            return $respuestaStaff;
        }

        $provider = Provider::where('provider_id', $staff->provider_id)->first();
        $staff_dentro = Staff::where('provider_id', $staff->provider_id)->sum('dentro');

        if ($staff_dentro >= $provider->limite_dentro && $status_ingreso) {
            $respuestaStaff['mensaje'] = 'El Staff del cliente está lleno';
            $respuestaStaff['valido'] = false;
        } else if ($staff->dentro == $status_ingreso) {
            $respuestaStaff['mensaje'] = 'Acción ya realizada';
            $respuestaStaff['valido'] = false;
        } else {
            $respuestaStaff['mensaje'] = 'Entrada verificada con éxito ';
            $respuestaStaff['valido'] = true;
            $staff->dentro = $status_ingreso;
            $staff->save();
        }

        return $respuestaStaff;
    }
}

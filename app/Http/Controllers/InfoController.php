<?php

namespace MPlaneta\Http\Controllers;

use Illuminate\Http\Request;
use MPlaneta\Http\Requests;
use MPlaneta\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use MPlaneta\Participante;
use MPlaneta\Variable;
use Illuminate\Support\Facades\Input;
use App\Item;
use DB;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carga.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //obtenemos el campo file 
        
        $file = $request->file('file');
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();

       //indicamos que queremos guardar un nuevo archivo en el disco local
     //  \Storage::disk('local')->put($nombre,  \File::get($file));


        //print_r(public_path().'\storage\Libro1.csv');
        $paht = public_path().'\storage\Libro1.csv';
        $time = time();
        $attiempo =  date("Y-m-d H:i:s", $time);
        if(Input::hasFile('file')){
            $path = Input::file('file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();


            if($request->input('tipo')==1){

                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                       
                        $insert[] = ['nombre' => $value->nombre, 
                                    'cedula' => $value->cedula,
                                    'edad' => $value->edad,
                                    'genero' => $value->genero,
                                    'created_at' => $attiempo,
                                    'updated_at' =>$attiempo];
                    }
                    if(!empty($insert)){
                        DB::table('participantes')->insert($insert);
                        dd('Insert Record successfully.');
                    }
                }
            }
            if($request->input('tipo')==2){

                if(!empty($data) && $data->count()){
                   // print_r($data); exit;
                    foreach ($data as $key => $value) {
                    $cumplimiento = ($value->resultado / $value->objetivo);
                    $insert[] =['id_participante' => $value->id, 
                                 'variable' => $value->variable,
                                 'mes' => $value->mes,
                                 'resultado' => $value->resultado,
                                 'objetivo' => $value->objetivo,
                                 'cumplimiento' => $cumplimiento,
                                 'created_at' => $attiempo,
                                 'updated_at' =>$attiempo
                                 ];
                    }
                    if(!empty($insert)){
                        DB::table('variables')->insert($insert);
                        dd('Insert Record successfully.');
                    }
                }
            }
             
       
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {

        $datos_archivo = array();
        $array_data =  DB::table('variables') 
                    ->select(DB::raw('max(id) as id, id_participante, mes, resultado, objetivo'))
                     ->groupBy('id_participante')
                     ->get();

        foreach ($array_data as $key => $value) {


            $nombre =  DB::table('participantes') 
                        ->select(DB::raw('nombre'))
                        ->where('id', $value->id_participante)
                        ->get();

            // Porcentaje
            $rango = number_format(round($value->resultado / $value->objetivo * 100, 2), 1, ',', ' ');


            // Cumplimieto Venta
            $data_venta =  DB::table('cumplimientos_ventas') 
                    ->select(DB::raw('id, categoria'))
                    ->orWhere(function($query) use ($rango)
                        {
                           
                               $query->where('minimo','<=', $rango)
                                     ->where('maximo','>=', $rango);
                        })
                     ->get();

            // Cumplimieto Venta
            $data_efectividad =  DB::table('cumplimientos_efectividad') 
                    ->select(DB::raw('id, tipo'))
                    ->orWhere(function($query) use ($rango)
                        {
                           
                               $query->where('minimo','<=', $rango)
                                     ->where('maximo','>=', $rango);
                        })
                     ->get();           

            // Cruces
      
            if(count($data_venta) == 1 && count($data_efectividad) == 1){
               
                $idventas = $data_venta[0]->id;
                $idefectividad = $data_efectividad[0]->id;

                $data_cruces =  DB::table('cruces_cumplimientos') 
                        ->select(DB::raw('efectivo'))
                        ->orWhere(function($query) use ($idventas, $idefectividad)
                            {
                               
                                   $query->where('id_venta','<=', $idventas)
                                         ->where('id_efectividad','>=', $idefectividad);
                            })
                         ->get(); 

                         $data_cruces  = $data_cruces[0]->efectivo;
            }else{
                $data_cruces  = 'No Tiene cruces';
            }


            if(count($data_venta) > 0){
                $data_venta = $data_venta[0]->categoria;
            }else{    
             $data_venta = 'No esta en el rango';
            }

            if(count($data_efectividad) > 0){
              $data_efectividad = $data_efectividad[0]->tipo;
            }else{    
             $data_efectividad = 'No esta en el rango';
            }


            $datos_archivo[]=array('id'=>$value->id, 
                            'id_user' => $value->id_participante, 
                            'Nombre' => $nombre[0]->nombre, 
                            'mes'=> $value->mes, 
                            '% Cumplimiento Ventas' => $rango, 
                            '% Cumplimiento Efectividad'=>$rango, 
                            'Categoria' => $data_venta, 
                            'Tipo' => $data_efectividad,  
                            'Dinero'=> $data_cruces
                            );
              

        }


       
         return Excel::create('Liquidacion', function($excel) use ($datos_archivo) {
            $excel->sheet('Liquidacion', function($sheet) use ($datos_archivo)
            {
                $sheet->fromArray($datos_archivo);
            });
        })->download($type);
 
    }



}

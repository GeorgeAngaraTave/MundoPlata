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
        $data = array('hola'=>'hola', 'hola2' => 'jojo');
         return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
 
    }



}

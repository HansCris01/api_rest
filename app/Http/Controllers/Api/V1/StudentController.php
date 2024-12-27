<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\student;
use Illuminate\Http\Request;
use Carbon\Carbon; //Me sirve para usar fecha con formato
use Exception; //Voy a usarlo para mi Try 
use Illuminate\Support\Facades\Log; //Esto es para que me de el registro de error en el Log

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function buscar_estudiante($id)
    {
       //BUSCAR ESTUDIANTE

       $datos['students'] = student::where('id','=',$id)->select("id","first_name","last_name","email","phone","birth_date","enrollment_date","status")->orderBy('id','desc')->get();
       return $datos;

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            // Intentamos la validación y operación
            try {
                // Validamos manualmente el campo birth_date dentro del try
                $validatedData = $request->validate([
                    'birth_date' => 'required|date|before_or_equal:' . now()->toDateString(), // Asegura que no sea una fecha futura
                ], [
                    'birth_date.before_or_equal' => 'No se permite una fecha futura en el campo birth_date', // Mensaje personalizado
                ]);
        
                // Si la validación pasa, continuamos con la lógica de guardado
                $student = new student();
                $student->first_name = $request->first_name;
                $student->last_name = $request->last_name;
                $student->email = $request->email;
                $student->phone = $request->phone;
                $student->birth_date = $request->birth_date;
                $student->enrollment_date = Carbon::now()->format('Y-m-d');
                $student->status = 1;
                $student->save();
        
                return response()->json(['message' => 'Estudiante creado correctamente'], 201);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Capturamos la excepción de validación para enviar un mensaje personalizado
                return response()->json(['message' => $e->errors()], 422); // 422 es un error de validación
            } catch (\Exception $e) {
                // Para otros errores que no sean de validación
                return response()->json(['message' => '¡Ya existe ese correo o teléfono!'], 500);
            }
        }
    


    /**
     * Display the specified resource.
     */
    public function show()
    {
        //LISTAR ESTUDIANTE

        $datos['students'] = student::select("id","first_name","last_name","enrollment_date","status")->orderBy('id','desc')->get();
        return $datos;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         //ACTUALIZAR ESTUDIANTE Y ACTIVACIÓN O DESACTIVACIÓN
      try{

        // Validamos manualmente el campo birth_date dentro del try
        $validatedData = $request->validate([
            'birth_date' => 'required|date|before_or_equal:' . now()->toDateString(), // Asegura que no sea una fecha futura
        ], [
            'birth_date.before_or_equal' => 'No se permite una fecha futura en el campo birth_date', // Mensaje personalizado
        ]);

        $datos = [
        "first_name" => $request->first_name,
        "last_name" => $request->last_name,
        "email" => $request->email,
        "phone" => $request->phone,
        "birth_date" => $request->birth_date,
        "status" => $request->status,
        ];

        student::where('id','=',$id)->update($datos);

        return response()->json(['message' => 'Estudiante modificado correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capturamos la excepción de validación para enviar un mensaje personalizado
            return response()->json(['message' => $e->errors()], 422); // 422 es un error de validación
        } catch (\Exception $e) {
            // Para otros errores que no sean de validación
            return response()->json(['message' => '¡Ya existe ese correo o teléfono!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        //
    }
}

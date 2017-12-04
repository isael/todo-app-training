<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

/**
 * En esta clase deben implementar los metodos vacios de acuerdo a lo
 * previamente estudiado acerca de RESTFul. Recuerda que DEBEN validar los datos
 * de entrada y de regresar lo que les pide el método correctamente.
 *
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * Este método del controlador regresa el listado del todos de la app
     * en un response del tipo json ordenados desde el más antiguo al más nuevo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Va por la lista de pendientes
        $todos = Todo::orderBy('created_at','DESC')->get();
        return $todos;
    }

    /**
     * Este método del controlador debe crear un nuevo registro todo
     * y al final regresa el registro creado en un response del tipo
     * json.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Valida que no sea vacio el pendiente
        $this->validate($request,[
            'text' => 'required'
        ]);
        //
        $todo = new Todo;
        $todo->text = $request->text;
        $todo->done = 0;
        $todo->save();
        return $todo;
    }

    /**
     * Modifica el item todo con el $id correspondiente
     * y regresa el mismo item modificado.
     *
     * @param integer $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        // TODO
        $this->validate($request,[
            'id' => 'required'
        ]);
        $todo = Todo::find($id);
        if($todo->done == 0)
            $todo->done = 1;
        else
            $todo->done = 0;
        $todo->save();
        return $todo;
    }

    /**
     * Elimina el registro y devuelve un response 200 en caso de exito o un 400
     * en caso de fallo pero igual en tipo json.
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        // TODO
        $response = "";
        try{
            $todo = Todo::FindOrFail($id);
            $todo->delete();
            $response = "{'response' : 200}";
        }catch(ModelNotFoundException $exception){
            $response = "{'response' : 400}";
        }
        return $response;
    }
}

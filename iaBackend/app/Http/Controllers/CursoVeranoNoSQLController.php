<?php

namespace App\Http\Controllers;

use App\CursoVeranoNoSQL;
use App\Mail\ConfirmationEmail;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CursoVeranoNoSQLController extends Controller
{

    /**
     * list: Lists all the subscriptors contained into MongoDB suscriptores collection
     * @return \Illuminate\Http\JsonResponse
     */
    public function list() {
        //if(auth('api')->user()) {
            $list = CursoVeranoNoSQL::all();
            return response()->json($list, 200);
        //}
        //return response()->json(['error' => 'Unauthorized'],401);
    }


    /**
     * new: Adds a new record to de MongoDB suscriptores collection sending a confirmation email
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function new(Request $request) {
        //if(auth('api')->user()) {

            $data = $request->toArray();

            if(count($data) == 4) {
                //Checks if the rut and email are uniques
                $valida_rut = CursoVeranoNoSQL::where('rut', $data['rut'])->get()->count();
                $valida_mail = CursoVeranoNoSQL::where('email', $data['email'])->get()->count();

                if ($valida_rut == 0 && $valida_mail == 0) {
                    $data = CursoVeranoNoSQL::create($request->all());
                    Mail::to($data['email'])->send(new ConfirmationEmail($data['nombre']));
                    return response()->json($data, 201);
                } else {
                    return response()->json(["error" => "Rut or Mail already taken"], 400);
                }
            }
            else {
                return response()->json(["error" => "Missing Data"], 400);
            }
        //}
        //return response()->json(["error" => "Unauthorized"], 401 );
    }

    /**
     * delete: Removes a record from the MongoDB collection.
     * @param $rut: applicants rut to remove
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($rut) {
        if(auth('api')->user()) {
            $applicant = CursoVeranoNoSQL::where('rut',$rut)->get()->first();

            if($applicant) {
                if($applicant->delete()) {
                    return response()->json(true,200);
                }
                else {
                    return response()->json(["error" => "Something happened!."], 500);
                }
            }
            else {
                return response()->json(["error" => "Bad Request"], 400);
            }
        }

        return response()->json(["error" => "Unauthorized"], 401 );
    }
}

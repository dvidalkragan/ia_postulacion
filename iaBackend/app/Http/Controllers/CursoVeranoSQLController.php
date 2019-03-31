<?php

namespace App\Http\Controllers;

use App\CursoVeranoSQL;
use App\Mail\ConfirmationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CursoVeranoSQLController extends Controller
{
    /**
     * list: lists all the applicants for the course saved into  MySQL
     * @return \Illuminate\Http\JsonResponse
     */
    public function list() {
        if(auth('api')->user()) {
            $list = CursoVeranoSQL::all();
            return response()->json($list, 200);
        }
        return response()->json(['error' => 'Unauthorized'],401);
    }

    /**
     * new: Subscribe a new person to the course using MySQL. then sends a confirmation email.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function new(Request $request) {
        $data = $request->toArray();

        //Checks if all the form data is received
        if(count($data) == 4) {

            //Checks if the rut and email are uniques
            $valida_rut = CursoVeranoSQL::where('rut',$data['rut'])->get()->count();
            $valida_mail = CursoVeranoSQL::where('email', $data['email'])->get()->count();

            //if no coincidences are found, creates the new course subscriptor
            if($valida_mail == 0 && $valida_rut == 0) {
                $curso = CursoVeranoSQL::create($data);

                Mail::to($data['email'])->send(new ConfirmationEmail($data['nombre']));

                return response()->json(true, 201);
            }
            else {
                return response()->json(["error" => "Rut or Mail already taken"], 400);
            }
        }
        else {
            return response()->json(["error" => "Missing Data"], 400);
        }
    }

    /**
     * delete: Removes a record from the MySQL database
     * @param $rut: applicants rut to remove
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($rut) {
        if(auth('api')->user()) {
            $applicant = CursoVeranoSQL::where('rut',$rut)->get()->first();

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

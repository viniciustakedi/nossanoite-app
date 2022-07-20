<?php

namespace App\Http\Controllers;

Use App\Models\Extra\Extra;

Use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class ExtraController extends Controller
{
    private $Extra;

    public function __construct(Extra $extra)
    {
        $this->extra = $extra;
    }

    public function getList()
    {
        $result = DB::table('Extras')
        ->select('Extras.ID', 'Extras.extra')
        ->get();

        return $result;
    }

    public function searchExtraById($id)
    {
        $result = DB::table('Extras')
        ->select('Extras.ID', 'Extras.extra')
        ->Where('Extras.ID', '=', $id)
        ->get();

        if($result != null || $result != "") 
        {
            return $result;
        }
        else
        {
            return 'Nenhuma atividade extra encontrada.';
        }
    }

    public function searchExtraByTitle($name)
    {
        $result = DB::table('Extras')
        ->select('Extras.ID', 'Extras.extra')
        ->Where('Extras.extra', 'like', "%{$name}%")
        ->get();

        return $result;
    }

    public function postExtra(Request $request)
    {
        try {
            $this->extra->create($request->all());
            return 'Atividade extra cadastrada com sucesso!!';
        } 
        catch (\Throwable $th) 
        {
            return 'Ops! Algo deu errado.';
        }
    }

    public function updateExtraById(Request $request, $id)
    {
        $extra = Extra::where('Extras.ID', '=', $id);
        try {
            if ($extra != "" || $extra != null) {
                $extra->update($extra->all());
                return "Atividade extra atualizada com sucesso!";
            } else {
                return "Nenhuma atividade extra encontrada com o id ".$id."...";
            }
        } catch (\Throwable $th) {
            return "Ops! Ocorreu um erro.";
        }
    }

    public function deleteExtra($id) {
        $extra = Extra::where('Extras.ID', '=', $id);
        try {
            if ($extra != "" || $extra != null) {
                $extra->delete($id);
                return "Atividade extra deletada com sucesso!";
                
            } else {
                return "Nenhuma atividade extra foi encontrada com o id ".$id."!";
            }
        } catch (\Throwable $th) {
            return "Ops, ocorreu um erro.";
        }
    }

}

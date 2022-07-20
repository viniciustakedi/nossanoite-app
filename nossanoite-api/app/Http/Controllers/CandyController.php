<?php

namespace App\Http\Controllers;

Use App\Models\Candy\Candy;

Use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class CandyController extends Controller
{
    private $Candy;

    public function __construct(Candy $candy)
    {
        $this->candy = $candy;
    }

    public function getList()
    {
        $result = DB::table('Candys')
        ->select('Candys.ID', 'Candys.candy')
        ->get();

        return $result;
    }

    public function searchCandyById($id)
    {
        $result = DB::table('Candys')
        ->select('Candys.ID', 'Candys.candy')
        ->Where('Candys.ID', '=', $id)
        ->get();
        if($result != null || $result != "") 
        {
            return $result;
        }
        else
        {
            return 'Nenhuma sobremesa encontrada.';
        }
    }

    public function searchCandyByTitle($name)
    {
        $result = DB::table('Candys')
        ->select('Candys.ID', 'Candys.candy')
        ->Where('Candys.candy', 'like', "%{$name}%")
        ->get();

        return $result;
    }

    public function postCandy(Request $request)
    {
        try {
            $this->candy->create($request->all());
            return 'Sobremesa cadastrada com sucesso!!';
        } 
        catch (\Throwable $th) 
        {
            return 'Ops! Algo deu errado.';
        }
    }

    public function updateCandyById(Request $request, $id)
    {
        $candy = Candys::where('Candys.ID', '=', $id);
        try {
            if ($candy != "" || $candy != null) {
                $candy->update($request->all());
                return "Sobremesa atualizada com sucesso!";
            } else {
                return "Nenhuma sobremesa encontrada com o id ".$id."...";
            }
        } catch (\Throwable $th) {
            return "Ops! Ocorreu um erro.";
        }
    }

    public function deleteCandy($id) {
        $candy = Candy::where('Candys.ID', '=', $id);
        try {
            if ($candy != "" || $candy != null) {
                $candy->delete($id);
                return "Sobremesa deletada com sucesso!";
                
            } else {
                return "Nenhuma sobremesa foi encontrado com o id ".$id."!";
            }
        } catch (\Throwable $th) {
            return "Ops, ocorreu um erro.";
        }
    }

}

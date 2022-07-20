<?php

namespace App\Http\Controllers;

Use App\Models\Drink\Drink;

Use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class DrinkController extends Controller
{
    private $Drink;

    public function __construct(Drink $drink)
    {
        $this->drink = $drink;
    }

    public function getList()
    {
        $result = DB::table('Drinks')
        ->select('Drinks.ID', 'Drinks.drink')
        ->get();

        return $result;
    }

    public function searchDrinkById($id)
    {
        $result = DB::table('Drinks')
        ->select('Drinks.ID', 'Drinks.drink')
        ->Where('Drinks.ID', '=', $id)
        ->get();

        if($result != null || $result != "") 
        {
            return $result;
        }
        else
        {
            return 'Nenhuma bebida encontrada.';
        }
    }

    public function searchDrinkByTitle($name)
    {
        $result = DB::table('Drinks')
        ->select('Drinks.ID', 'Drinks.drink')
        ->Where('Drinks.drink', 'like', "%{$name}%")
        ->get();

        return $result;
    }

    public function postDrink(Request $request)
    {
        try {
            $this->drink->create($request->all());
            return 'Bebida cadastrada com sucesso!!';
        } 
        catch (\Throwable $th) 
        {
            return 'Ops! Algo deu errado.';
        }
    }

    public function updateDrinkById(Request $request, $id)
    {
        $drink = Drink::where('Drinks.ID', '=', $id);
        try {
            if ($drink != "" || $drink != null) {
                $drink->update($request->all());
                return "Bebida atualizada com sucesso!";
            } else {
                return "Nenhuma bebida encontrada com o id ".$id."...";
            }
        } catch (\Throwable $th) {
            return "Ops! Ocorreu um erro.";
        }
    }

    public function deleteDrink($id) {
        $drink = Drink::where('Drinks.ID', '=', $id);
        try {
            if ($drink != "" || $drink != null) {
                $drink->delete($id);
                return "Bebida deletada com sucesso!";
                
            } else {
                return "Nenhuma bebida foi encontrado com o id ".$id."!";
            }
        } catch (\Throwable $th) {
            return "Ops, ocorreu um erro.";
        }
    }

}

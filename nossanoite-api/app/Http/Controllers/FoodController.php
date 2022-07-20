<?php

namespace App\Http\Controllers;

Use App\Models\Food\Food;

Use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class FoodController extends Controller
{
    private $food;

    public function __construct(Food $food)
    {
        $this->food = $food;
    }

    public function getList()
    {
        $result = DB::table('Foods')
        ->select('Foods.ID', 'Foods.food')
        ->get();

        return $result;
    }

    public function searchFoodByTitle($name)
    {
        $result = DB::table('Foods')
        ->select('Foods.ID', 'Foods.food')
        ->Where('Foods.food', 'like', "%{$name}%")
        ->get();

        return $result;
    }

    public function postFood(Request $request)
    {
        try {
            $this->food->create($request->all());
            return 'Comida cadastrada com sucesso!!';
        } 
        catch (\Throwable $th) 
        {
            return 'Ops! Algo deu errado.';
        }
    }

    public function updateFoodById(Request $request, $id)
    {
        $food = Food::where('Foods.ID', '=', $id);
        try {
            if ($food != "" || $food != null) {
                $food->update($request->all());
                return "Comida atualizada com sucesso!";
            } else {
                return "Nenhuma comida encontrada com o id ".$id."...";
            }
        } catch (\Throwable $th) {
            return "Ops! Ocorreu um erro.";
        }
    }

    public function deleteFood($id) {
        $food = Food::where('Foods.ID', '=', $id);
        try {
            if ($food != "" || $food != null) {
                $food->delete($id);
                return "Comida deletada com sucesso!";
                
            } else {
                return "Nenhuma comida foi encontrado com o id ".$id."!";
            }
        } catch (\Throwable $th) {
            return "Ops, ocorreu um erro.";
        }
    }

}

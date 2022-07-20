<?php

namespace App\Http\Controllers;

Use App\Models\Movie\Movie;

Use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class MovieController extends Controller
{
    private $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getList()
    {
        $result = DB::table('Movies')
        ->join('Plataforms', 'Movies.ID_plataform', '=', 'Plataforms.ID')
        ->select('Movies.ID', 'Movies.title', 'Movies.observation','Plataforms.plataform')
        ->get();

        return $result;
    }

    public function searchMovieByTitle($title)
    {
        $result = DB::table('Movies')
        ->join('Plataforms', 'Movies.ID_plataform', '=', 'Plataforms.ID')
        ->select('Movies.ID', 'Movies.title', 'Movies.observation','Plataforms.plataform')
        ->Where('Movies.title', 'like', "%{$title}%")
        ->get();

        return $result;
    }

    public function searchMovieById($id)
    {
        $result = DB::table('Movies')
        ->join('Plataforms', 'Movies.ID_plataform', '=', 'Plataforms.ID')
        ->select('Movies.ID', 'Movies.title', 'Movies.observation','Plataforms.plataform')
        ->where('Movies.ID', '=', $id)
        ->get();

        if($result != null && $result != "") 
        {
            return $result;
        }
        else
        {
            return 'Nenhum veiculo encontrado!';
        }
    }

    public function postMovie(Request $request)
    {
        try {
            $this->movie->create($request->all());
            return 'Filme cadastrado com sucesso!!';
        } 
        catch (\Throwable $th) 
        {
            return 'Ops! Algo deu errado.';
        }
    }

    public function updateMovieById(Request $request, $id)
    {
        $movie = Movie::where('Movies.ID', '=', $id);
        try {
            if ($movie != "" || $movie != null) {
                $movie->update($request->all());
                return "Filme atualizado com sucesso!";
            } else {
                return "Nenhum filme encontrado com o id ".$id."...";
            }
        } catch (\Throwable $th) {
            return "Ops! Ocorreu um erro.";
        }
    }

    public function deleteMovie($id) {
        $movie = Movie::where('Movies.ID', '=', $id);
        try {
            if ($movie != "" || $movie != null) {
                $movie->delete($id);
                return "Filme deletado com sucesso!";
                
            } else {
                return "Nenhum filme foi encontrado com o id ".$id."!";
            }
        } catch (\Throwable $th) {
            return "Ops, ocorreu um erro.";
        }
    }

}

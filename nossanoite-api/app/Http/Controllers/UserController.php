<?php

    namespace App\Http\Controllers;

    Use App\Models\User\User;

    Use Illuminate\Http\Request;

    use Illuminate\Support\Facades\DB;

    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        private $user;

        public function __construct(User $user)
        {
            $this->user = $user;

            $this->middleware('auth', ['only' => [
                'getAllUsers',
                'postUser',
                'updateUser'
            ]]);
        }

        public function getAllUsers()
        {
            $result = DB::table('User')
            ->select('User.ID', 'User.name', 'User.email', 'User.password')
            ->get();

            return $result;
        }

        //Listar administrador por id
        public function getById($id)
        {
            $result = DB::table('User')
            ->select('User.ID', 'User.name', 'User.email', 'User.password')
            ->where('User.ID', '=', $id)
            ->get();

            if($result != null || $result != "") 
            {
                return $result;
            }
            else
            {
                return 'Nenhum usuario encontrado.';
            }
        }

        //Cadastrar um administrador
        public function postUser(Request $request)
        {   
            $credentials =  $request;
            $credentials['password'] = Hash::make($credentials['password']); 

            try 
            {
                $this->user->create($request->all());
                return 'Usuario cadastrado com sucesso';
            } 
            catch (\Throwable $th)
            {
                return 'Ops! Ocorreu um erro.';
            }
        }

        //Atualizar um administrador por id
        public function updateUser(Request $request, $id)
        {
            $user = User::where('User.ID', '=', $id);
            $credentials =  $request;
            $credentials['password'] = Hash::make($credentials['password']); 
            try {
                if ($user != "" || $user != null) {
                    $user->update($request->all());
                    return "Usuario atualizado com sucesso!";
                } else
                {
                    return "Nenhum usuario encontrado com o id ".$id."!";
                }
            } catch (\Throwable $th) {
                return "Ops! Ocorreu um erro.";
            }
        }

        //Deletar um administrador por id
        public function deleteUser($id)
        {
            $user = User::where('User.ID', '=', $id);
            try {
                if ($user != "" || $user != null) {
                    $user->delete($id);
                    return "Usuario deletado com sucesso!";
                    
                } else {
                    return "Nenhum usuario foi encontrado id ".$id."!";
                }
            } catch (\Throwable $th) {
                return "Ops, ocorreu um erro.";
            }
        }

    }
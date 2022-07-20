<?php

    declare(strict_types=1);

    namespace App\Models\User;
    use Illuminate\Database\Eloquent\Model;
    
    use Tymon\JWTAuth\Contracts\JWTSubject;
    use Illuminate\Notifications\Notifiable;
    
    use Illuminate\Auth\Authenticatable;
    use Illuminate\Auth\Passwords\CanResetPassword;
    use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
    use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
    
    class User extends Model implements AuthenticatableContract, CanResetPasswordContract, JWTSubject
    {
        use Authenticatable, CanResetPassword;

        //Tabela que a model vai representar
        protected $table = 'User';
        protected $primaryKey  = 'ID';

        //Campos permitidos para a atribuição em massa
        protected $fillable = [
            'name',
            'email',
            'password',
        ];

        //Ocultar campos sensiveis
        protected $hidden = [
            'password'
        ];

        // caso a gente use datetime no mysql
        public $timestamps = false;

        //Regras de validação da model
        public array $rules = [
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|max:255|email:rfc,dns',
            'password' => 'required|between:6,255',
        ];

        public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        public function getJWTCustomClaims()
        {
            return [];
        }
    }
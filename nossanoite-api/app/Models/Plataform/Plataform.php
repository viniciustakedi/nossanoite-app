<?php
    declare(strict_types=1);
    namespace App\Models\Plataform;
    use Illuminate\Database\Eloquent\Model;
    
    class Plataform extends Model
    {
        //Tabela que a model vai representar
        protected $table = 'Plataforms';
        
        // caso a gente use datetime no mysql
        public $timestamps = false;
    
        //Campos permitidos para a atribuição em massa
        protected $fillable = [
            'plataform',
        ];
    
        //Regras de validação da model
        public array $rules = [
            'plataform' => 'required|min:4|max:255'
        ];
    }
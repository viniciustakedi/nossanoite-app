<?php
    declare(strict_types=1);
    namespace App\Models\Candy;
    use Illuminate\Database\Eloquent\Model;
    
    class Candy extends Model
    {
        //Tabela que a model vai representar
        protected $table = 'Candys';
        
        // caso a gente use datetime no mysql
        public $timestamps = false;
    
        //Campos permitidos para a atribuição em massa
        protected $fillable = [
            'candy',
        ];
    
        //Regras de validação da model
        public array $rules = [
            'candy' => 'required|min:4|max:255'
        ];
    }
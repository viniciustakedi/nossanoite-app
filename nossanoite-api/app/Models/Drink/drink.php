<?php
    declare(strict_types=1);
    namespace App\Models\Drink;
    use Illuminate\Database\Eloquent\Model;
    
    class Drink extends Model
    {
        //Tabela que a model vai representar
        protected $table = 'Drinks';
        
        // caso a gente use datetime no mysql
        public $timestamps = false;
    
        //Campos permitidos para a atribuição em massa
        protected $fillable = [
            'drink',
        ];
    
        //Regras de validação da model
        public array $rules = [
            'drink' => 'required|min:2|max:255'
        ];
    }
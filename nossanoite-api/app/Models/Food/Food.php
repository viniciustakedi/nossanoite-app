<?php
    declare(strict_types=1);
    namespace App\Models\Food;
    use Illuminate\Database\Eloquent\Model;
    
    class Food extends Model
    {
        //Tabela que a model vai representar
        protected $table = 'Foods';
        
        // caso a gente use datetime no mysql
        public $timestamps = false;
    
        //Campos permitidos para a atribuição em massa
        protected $fillable = [
            'food',
        ];
    
        //Regras de validação da model
        public array $rules = [
            'food' => 'required|min:4|max:255'
        ];
    }
<?php
    declare(strict_types=1);
    namespace App\Models\Extra;
    use Illuminate\Database\Eloquent\Model;
    
    class Extra extends Model
    {
        //Tabela que a model vai representar
        protected $table = 'Extras';
        
        // caso a gente use datetime no mysql
        public $timestamps = false;
    
        //Campos permitidos para a atribuição em massa
        protected $fillable = [
            'extra',
        ];
    
        //Regras de validação da model
        public array $rules = [
            'extra' => 'required|min:4|max:255'
        ];
    }
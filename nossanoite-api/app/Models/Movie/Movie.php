<?php 
    declare(strict_types=1);
    namespace App\Models\Movie;
    use Illuminate\Database\Eloquent\Model;
    
    class Movie extends Model
    {
        //Tabela que a model vai representar
        protected $table = 'Movies';
        protected $primaryKey  = 'id_movie';

        //Campos permitidos para a atribuição em massa
        protected $fillable = [
            'title',
            'observation',
            'ID_plataform',
        ];

        // caso a gente use datetime no mysql
        public $timestamps = false;

        //Regras de validação da model
        public array $rules = [
            'title' => 'required|min:2|max:255',
            'observation' => 'required|max:255|',
            'ID_plataform' => 'numeric'
        ];

        //Chamar a chave estrangeira
        public function Plataforms()
        {
            return $this.hasMany(Plataform::class);
        }
    }

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;
class ChemicalComposition extends Model
{
    
  // use SoftDeletes;


        public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate();
        });
    }
    
    public function getRouteKeyName()
    {
        return 'uuid';
    }
     /**
     * The table associated with the model.
     *
     * @var string 
     */
    protected $table = 'chemical_compositions';
    protected $fillable =['id','drug_id','composition_quantity_id','composition_id'];


    protected $dates = ['deleted_at'];
}

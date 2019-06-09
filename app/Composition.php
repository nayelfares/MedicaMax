<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\CompositionQuantity;

class Composition extends Model
{
    // use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string 
     */
    protected $table = 'compositions';
    protected $dates = ['deleted_at'];
 
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate();        });
    } 
    
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    protected $fillable =['id','en_name','ar_name' ,'status_id'];

   /* public function compositionQuantity(){
        return $this->hasMany('App\CompositionQuantity');
    }*/
}
 
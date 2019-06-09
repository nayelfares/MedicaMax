<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompositionQuantity extends Model
{
        // use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string 
     */
    protected $table = 'composition_quantities';
    protected $dates = ['deleted_at'];
 
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
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    protected $fillable =['id','composition_id', 'quantity'];
}

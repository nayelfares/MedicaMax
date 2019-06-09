<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
class Country extends Model
{
     //use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string 
     */
    protected $table = 'countries';
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

    protected $fillable =['en_name','ar_name','status_id'];
}
 
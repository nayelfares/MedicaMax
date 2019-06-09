<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class DailyDose extends Model
{
 //  use SoftDeletes;


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
    protected $table = 'daily_doses';
    protected $fillable =['classification_id','giving_id','amount','note'];


    protected $dates = ['deleted_at'];
}

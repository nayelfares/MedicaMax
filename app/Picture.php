<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
class Picture extends Model
{
  //   use SoftDeletes;
     protected $dates = ['deleted_at'];
     
     protected $table = 'pictures';

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


     protected $guarded = [];

    protected $fillable =['title','path','class_name','object_id'];
}

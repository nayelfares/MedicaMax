<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictionary extends Model
{
    // use SoftDeletes;
     protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     *
     * @var string 
     */ 
    protected $table = 'dictionaries';

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
    //protected $guarded = [];

    protected $fillable =['id','arabicText' ,'englishText' ,'arabicTextRaw','englishTextRaw'
    ,'status','dictionary_id'];
}

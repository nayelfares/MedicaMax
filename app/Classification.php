<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
class Classification extends Model
{
    // use SoftDeletes;
     protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     *
     * @var string 
     */ 
    protected $table = 'classifications';

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

    protected $fillable =['id','en_term','ar_term','code','parent_id','parent_code','note','ar_note','status_id',
    'classification_level','parent_index','index','s_ar_term','bold','italic','text_color','background_color','under_line'];

    public function childs(){
        return $this->hasMany('App\Classification','parent_id','id');
    }
}

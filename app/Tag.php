<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
     // use SoftDeletes;
     protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     *
     * @var string 
     */ 
    protected $table = 'tags';

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

    protected $fillable =['id','tag_code' ,'tag_text' ,'tag_bold','tag_italic'
    ,'tag_under_line','tag_text_color','tag_background_color','tag_border',
    'tag_font_family','tag_font_size','tag_sub' , 'tag_sup','tag_border_color','tag_text_for_replace','tag_border_radius'];
}

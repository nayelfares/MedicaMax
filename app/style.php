<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Style extends Model
{
     // use SoftDeletes;
     protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     *
     * @var string 
     */ 
    protected $table = 'styles';

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

    protected $fillable =['id','style_name' ,'style_bold','style_italic'
    ,'style_under_line','style_text_color','style_background_color','style_border',
    'style_font_family','style_font_size'];

    //default value
    protected $attributes = [
        'style_bold' => 'normal',
        'style_italic' => 'normal',
        'style_under_line' => 'none',
        'style_text_color' => '#000000',
        'style_background_color' => 'ffffff',
        'style_border' => 'none',
        'style_font_family' => 'Arial',
        'style_font_size' => 14,
    ];
}
 
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Message extends Model
{
    use Searchable;
    //si tenemos un array vacio no protege nada, se deberia de proteger contraseñas etc
    protected $guarded = [];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function getImageAttribute($image)
    {
    	if (!$image || starts_with($image, 'http')) {
    		return $image;
    	}

    	return \Storage::disk('public')->url($image);
    }

    public function responses(){
    	return $this->hasMany(Response::class)->with('user')->latest();
    }
}

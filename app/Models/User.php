<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password',
	];


    protected $appends=['full_name'];

   
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

//cast
     protected $casts = [
        'created_at'=>'datetime:Y-m-d',
        'updated_at'=>'datetime:Y-m-d'
    ];
   

    public function getFullNameAttribute()
    {
    return "{$this ->name} {$this->last_name}"  ;

    }

    //Mutadores
    public function setPasswordAttribute($value)
    {   

        $this->attributes['password'] = bcrypt($value);
    }

    public function setRememberTokenAttribute($value)
    {

    $this->attributes['remember_token']= Str::random(30) ;
    }
    





    //Relaciones
   
    public function customerLends()
    {
        return $this->hasMany(Lend::class, 'customer_user_id', 'id');
    }

       public function ownerLends()
    {
        return $this->hasMany(Lend::class, 'owner_user_id', 'id');
    }
}

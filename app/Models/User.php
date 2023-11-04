<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Lend;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
    public function setPasswordAttributte($value)
    {   

    $this->attributes['password']=bcrypt($value) ;
    }

    public function setRememberTokenAttributte($value)
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

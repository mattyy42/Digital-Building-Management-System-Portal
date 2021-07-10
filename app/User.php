<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','phone_number', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->hasOne(Role::class);
    }
    public function application(){
        return $this->hasMany(Application::class);
    }
    public function Plan_Consent(){
        return $this->hasMany(Plan_Consent::class);
    }
    public function Plan_Consent_BO(){
        return $this->hasMany(Plan_Consent_BO::class);
    }
    public function complain()
    {
        # code...
        return $this->belongsTo(User::class);
    }
}

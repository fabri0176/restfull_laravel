<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    protected $table = 'users';
    use HasFactory, Notifiable, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    const USER_VERIFICADO = '1';
    const USER_NO_VERIFICADO = '0';

    const USER_ADMIN = '1';
    const USER_REGULAR = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function esVerificado()
    {
        return $this->verified === self::USER_VERIFICADO;
    }


    public function esAdmin()
    {
        return $this->admin === self::USER_ADMIN;
    }

    public static function generarVerificationToken()
    {
        return Str::random(40);
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_strtolower($value);
    }

    /**
     * Undocumented function
     *
     * @param string $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}

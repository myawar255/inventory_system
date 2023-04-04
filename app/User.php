<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function complete_name()
    {
        return $this->name.'-'. $this->getRoleNames()[0];
    }
    public function complete_name_styled()
    {
        $role= $this->getRoleNames()[0];
        $color= $role=='student' ? 'tertiary':($role=='faculty' ? 'quaternary':'primary');
        if ($this->deleted_at!=null) {
            return '<s><span>' . $this->name . '&nbsp;<span class="badge bg-' . $color . '">' . $this->getRoleNames()[0] . '</span></s>';
        }else{
            return '<span>' . $this->name . '&nbsp;<span class="badge bg-' . $color . '">' . $this->getRoleNames()[0] . '</span>';
        }
    }
}

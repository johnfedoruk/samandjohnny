<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Session;

class User extends Authenticatable
{
    use Notifiable;

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
    public function comments() {
      return $this->hasMany("App\Comment");
    }
    public function hasRoles($roles) {
      if(!is_array($roles))
        return hasRole("superadmin") || hasRole($roles);
      $roles[] = "superuser";
      foreach($roles as $role)
        if($this->hasRole($role))
          return true;
      return false;
    }
    public function hasRole($role) {
      if(!isset($this->role_id))
        return false;
      return Role::find($this->role_id)->name==$role;
    }
}

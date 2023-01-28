<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'route', 'parent_id', 'type'
    ];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function submenus() 
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}

<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // protected $with = ['module'];
}

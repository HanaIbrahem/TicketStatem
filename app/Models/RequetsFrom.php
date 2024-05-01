<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequetsFrom extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function tickets()
    {
        return $this->hasMany(Tickt::class, 'requets_id');
    }

}



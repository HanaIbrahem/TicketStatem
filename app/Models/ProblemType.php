<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemType extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function tickets()
    {
        return $this->hasMany(Tickt::class, 'problem_id');
    }
}

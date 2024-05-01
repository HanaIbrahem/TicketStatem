<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickt extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function problemType()
    {
        return $this->belongsTo(ProblemType::class, 'problem_id');
    }
    
    public function requestFrom()
    {
        return $this->belongsTo(RequetsFrom::class, 'requets_id');
    }
    
    public function solution()
    {
        return $this->belongsTo(Solution::class, 'solution_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

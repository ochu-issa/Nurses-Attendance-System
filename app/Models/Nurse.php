<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Attandance()
    {
        return $this->hasMany(Attandance::class, 'nurse_id');
    }
}

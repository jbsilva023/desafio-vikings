<?php


namespace App\Models;

use JbSilva\ORM\Model;

class Enderecos extends Model
{
    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
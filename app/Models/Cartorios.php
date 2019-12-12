<?php


namespace App\Models;

use JbSilva\ORM\Model;

class Cartorios extends Model
{
    public function endereco()
    {
        return $this->hasOne(Enderecos::class);
    }
}
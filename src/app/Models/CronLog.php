<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    public $fillable = [ 'description' ];

    public function getDescription()
    {
        return $this->description;
    }
}

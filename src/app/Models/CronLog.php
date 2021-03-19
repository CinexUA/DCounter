<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    public $fillable = [ 'description', 'type' ];

    public function getDescription()
    {
        return $this->description;
    }
}

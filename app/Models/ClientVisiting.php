<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientVisiting extends Model
{
    public $table = 'clients_visiting';

    public $fillable = [
        'description',
    ];

    //region relations
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    //endregion relations

    public function getDescription()
    {
        return $this->description;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Currency extends Model
{
    use HasTranslations;

    public $timestamps = false;
    public $translatable = ['name'];
    protected $fillable = ['name'];

    //region relations
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    //endregion relations

    public function getName(): string
    {
        return $this->name;
    }
}

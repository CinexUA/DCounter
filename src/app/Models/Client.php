<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use HasFactory, Filterable, Sortable;

    public $sortable = ['id'];
    public $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //region relations
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    //endregion relations


    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    //region mutators
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    //endregion mutators
}

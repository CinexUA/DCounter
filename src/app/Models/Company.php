<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use HasFactory, Filterable, Sortable;

    public $sortable = ['id'];
    public $fillable = [
        'name', 'description', 'price_per_month'
    ];

    //region relations
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
    //endregion relations


    public function compareUserId(int $userId)
    {
        return $this->getOrganizerId() === $userId;
    }

    public function getOrganizerId(): int
    {
        return $this->organizer_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    public function getPricePerMonth(): float
    {
        return $this->price_per_month;
    }

    public function getOrganizer()
    {
        return $this->organizer();
    }
}

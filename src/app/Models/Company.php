<?php

namespace App\Models;

use Bavix\Wallet\Traits\HasWallet;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use HasFactory, Filterable, Sortable, HasWallet;

    public $sortable = ['id'];
    public $fillable = [
        'name', 'description', 'price_per_month', 'visiting_clients_log'
    ];

    //region relations
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'company_id');
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

    public function getPricePerMonthFormatted($decimals = 2): string
    {
        return number_format($this->getPricePerMonth(), $decimals);
    }

    public function getOrganizer()
    {
        return $this->organizer();
    }
}

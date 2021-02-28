<?php

namespace App\Models;

use Bavix\Wallet\Traits\HasWalletFloat;
use Bavix\Wallet\Interfaces\Wallet;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model implements Wallet
{
    use HasFactory, Filterable, Sortable, HasWalletFloat;

    public const STATUS_FROZEN = 0;
    public const STATUS_ACTIVE = 10;

    public $sortable = ['id'];
    public $fillable = [
        'name', 'email', 'password', 'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status' => 'integer'
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

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getStatusAsBadge()
    {
        $currentStatus = $this->getStatus();
        $color  = collect($this->getColorsStatues())->get($currentStatus);
        $status = collect($this->getStatusValues())->get($currentStatus);
        return sprintf('<span class="badge bg-%s">%s</span>', $color, $status);
    }

    public function getColorsStatues()
    {
        return [
            self::STATUS_FROZEN => 'primary',
            self::STATUS_ACTIVE => 'success',
        ];
    }

    public function getStatusValues()
    {
        return [
            self::STATUS_FROZEN => trans('shared.frozen'),
            self::STATUS_ACTIVE => trans('shared.active'),
        ];
    }

    //region mutators
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    //endregion mutators
}

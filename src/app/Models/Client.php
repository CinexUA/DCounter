<?php

namespace App\Models;

use Bavix\Wallet\Traits\HasWalletFloat;
use Bavix\Wallet\Interfaces\Wallet;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model implements Wallet
{
    use HasFactory, Filterable, Sortable, HasWalletFloat;

    public const STATUS_FROZEN = 0;
    public const STATUS_ACTIVE = 10;

    public $sortable = ['id'];
    public $fillable = [
        'name', 'email', 'password', 'status', 'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status' => 'integer',
        'left_days' => 'integer',
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

    public function getLeftDays(): int
    {
        return $this->left_days;
    }

    public function getLeftDaysTransVariant(): string
    {
        return $this->getLeftDays() . ' '
            . trans_choice('shared.days_trans_variant', $this->getLeftDays());
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

    public function colorizeBalance(): string
    {
        $type = ($this->balanceFloat > 0) ? 'success' : 'danger';
        return sprintf('<span class="text-%s">%s</span>', $type, $this->balanceFloat);
    }

    public function decreaseLeftDays(): void
    {
        $this->left_days--;
        $this->save();
    }

    public function calculateNextLeftDays(): void
    {
        $this->left_days = Carbon::now()->addMonth()->diffInDays();
        $this->save();
    }

    public function hasSubscriptionExpired(): bool
    {
        return $this->getLeftDays() <= 0;
    }

    public function isFrozen()
    {
        return $this->getStatus() === self::STATUS_FROZEN;
    }

    public function isActive()
    {
        return $this->getStatus() === self::STATUS_ACTIVE;
    }

    //region mutators
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    //endregion mutators
}

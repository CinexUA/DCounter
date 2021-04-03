<?php

namespace App\Models;

use Bavix\Wallet\Traits\HasWalletFloat;
use Bavix\Wallet\Interfaces\Wallet;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model implements Wallet
{
    use Filterable, Sortable, HasWalletFloat, Notifiable;

    public const STATUS_FROZEN = 0;
    public const STATUS_ACTIVE = 10;

    public $sortable = ['id'];
    public $fillable = [
        'name', 'email', 'phone', 'password', 'status', 'preferred_language', 'remember_token'
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

    public function visiting()
    {
        return $this->hasMany(ClientVisiting::class);
    }
    //endregion relations


    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone ?? '';
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

    public function colorizeBalance(?bool $withPrefix = false): string
    {
        $type = ($this->balanceFloat > 0) ? 'success' : 'danger';
        $prefix = $withPrefix ? $this->company->currency->getName() : '';
        return sprintf('<span class="text-%s">%s%s</span>', $type, $this->balanceFloat, $prefix);
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

    public function isNegativeBalance(): bool
    {
        return $this->balanceFloat < 0;
    }

    //region mutators
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    //endregion mutators
}

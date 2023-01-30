<?php

namespace App\Models;

use Bavix\Wallet\Traits\HasWallet;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use Filterable, Sortable, HasWallet;

    const SMS_NOTIFICATION_DISABLED = 0;
    const SMS_NOTIFICATION_ENABLED = 1;

    public $sortable = ['id'];
    public $fillable = [
        'name',
        'description',
        'price_per_month',
        'sms_notification',
        'visiting_clients_log',
        'currency_id'
    ];

    //region scopes
    public function scopeSmsNotificationEnabled(Builder $builder)
    {
        $builder->where('sms_notification', self::SMS_NOTIFICATION_ENABLED);
    }
    //endregion scopes

    //region relations
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'company_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
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

    public function getColorsSmsNotificationStatues()
    {
        return [
            self::SMS_NOTIFICATION_DISABLED => 'danger',
            self::SMS_NOTIFICATION_ENABLED => 'success',
        ];
    }

    public function getStatusSmsNotificationsValues()
    {
        return [
            self::SMS_NOTIFICATION_DISABLED => trans('shared.off'),
            self::SMS_NOTIFICATION_ENABLED => trans('shared.on'),
        ];
    }

    public function getStatusSmsNotificationAsBadge()
    {
        $color  = collect($this->getColorsSmsNotificationStatues())->get($this->sms_notification);
        $status = collect($this->getStatusSmsNotificationsValues())->get($this->sms_notification);
        return sprintf('<span class="badge bg-%s">%s</span>', $color, $status);
    }

    public function isEnabledSmsNotification(): bool
    {
        return self::SMS_NOTIFICATION_ENABLED == $this->sms_notification;
    }
}

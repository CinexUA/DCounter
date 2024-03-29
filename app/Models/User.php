<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use EloquentFilter\Filterable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable, InteractsWithMedia, Filterable, Sortable;

    public $sortable = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //region relations
    public function companies()
    {
        return $this->hasMany(Company::class, 'organizer_id');
    }
    //endregion relations

    //region redefine MediaLibrary methods
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(256)
            ->height(256)
            ->fit('fill', 256, 256)
            ->quality(80)
            ->format('jpg')
            ->nonQueued();
    }
    //endregion redefine MediaLibrary methods

    //region getters
    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUserRolesAsString()
    {
        return implode(', ', $this->roles()->pluck('display_name')->toArray());
    }

    public function getUserRolesAsStringWrap()
    {
        $rolesArray = $this->roles()->pluck('display_name')->toArray();
        $rolesArray = array_map(function ($el){
            return sprintf('<span class="badge bg-success">%s</span>', $el);
        }, $rolesArray);
        return implode(', ', $rolesArray);
    }
    //endregion getters

    //region mutators
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    //endregion mutators
}

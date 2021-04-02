<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    //region getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getDisplayName(): string
    {
        return $this->display_name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function getRolesPermissionsAsString()
    {
        return implode(', ', $this->permissions()->pluck('display_name')->toArray());
    }

    public function getRolesPermissionsAsStringWrap()
    {
        $permissionsArray = $this->permissions()->pluck('display_name')->toArray();
        $permissionsArray = array_map(function ($el){
            return sprintf('<span class="badge bg-success">%s</span>', $el);
        }, $permissionsArray);
        return implode(', ', $permissionsArray);
    }
    //endregion getters
}

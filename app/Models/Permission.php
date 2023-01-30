<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
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
    //endregion getters
}

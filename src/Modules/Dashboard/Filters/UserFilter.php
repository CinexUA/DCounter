<?php

namespace Modules\Dashboard\Filters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function filterById($id)
    {
        return $this->where('id', $id);
    }

    public function filterByName($name)
    {
        return $this->where('name', $name);
    }

    public function filterByEmail($email)
    {
        return $this->where('email', $email);
    }

    public function filterByRoles($roles)
    {
        return $this->whereHas('roles', function($q) use($roles) {
            $q->whereIn('id', $roles);
        });
    }
}

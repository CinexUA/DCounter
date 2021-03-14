<?php

namespace App\Observers;

use App\Models\Company;

class CompanyObserver
{
    public function deleting(Company $company){
        $company->clients->each->delete();
    }
}

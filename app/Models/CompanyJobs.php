<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyJobs extends Model
{
    use HasFactory;


    protected $table =  'company_jobs';

    protected $fillable = [
       'form',
       'experience',
       'gender',
       'career',
       'requirements',
       'education',
       'description',
       'company_id',
    ];


    public function company() {

        return $this->hasMany(Company::class);

    }
}




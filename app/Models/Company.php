<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'company_name',
        'company_tagline',
        'company_logo',
        'company_status',
        'company_field',
        'company_introduce',
        'company_evaluate',
        'company_url_iframe',
    ];

    public function jobs() {

        return $this->hasMany(CompanyJob::class,'company_id');

    }
}

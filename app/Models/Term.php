<?php

namespace App\Models;

use Corcel\Model\Term as CorcelTerm;

class Term extends CorcelTerm
{
    protected $connection = 'wordpress';

    public function taxonomies()
    {
        return $this->hasMany(Taxonomy::class, 'term_id');
    }
}
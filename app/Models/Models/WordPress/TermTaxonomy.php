<?php

namespace App\Models\WordPress;

use Corcel\Model\Taxonomy;

class TermTaxonomy extends Taxonomy
{
    protected $connection = 'wordpress';
}

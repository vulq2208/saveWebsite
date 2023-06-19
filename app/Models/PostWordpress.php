<?php // File: app/Post.php

namespace App\Models;

use Corcel\Model\Post as Corcel;

class PostWordpress extends Corcel
{
    protected $connection = 'wordpress';

    public function customMethod() {
        //
    }
}
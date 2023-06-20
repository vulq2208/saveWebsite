<?php

namespace App\Models\WordPress;

use Corcel\Model\Post as CorcelPost;

class Post extends CorcelPost
{

    protected $connection = 'wordpress';
    protected $table = 'posts';

}

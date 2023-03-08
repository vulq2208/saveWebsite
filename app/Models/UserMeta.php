<?php


namespace Corcel\Model\Meta;

use Corcel\Model\User;

class UserMeta extends Meta
{
    protected $connection = 'wordpress';
    protected $table = 'wp_usermeta';

}

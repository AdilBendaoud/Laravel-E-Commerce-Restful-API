<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToThisUser extends Exception
{
    public function render()
    {
        return ["error " => "product not belongs to this user"];
    }
}
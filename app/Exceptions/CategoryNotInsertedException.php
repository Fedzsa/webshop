<?php

namespace App\Exceptions;

use Exception;

class CategoryNotInsertedException extends Exception
{
    public function render($request) {
        return back()->withErrors(['status' => $this->getMessage()])->withInput($request->all());
    }
}

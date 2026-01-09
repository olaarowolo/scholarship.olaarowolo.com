<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitController extends Controller
{
    public function createMasterBranch()
    {
        $output = shell_exec('git branch master');
        return "<pre>$output</pre>";
    }
}

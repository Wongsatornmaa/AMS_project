<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BackOfficeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

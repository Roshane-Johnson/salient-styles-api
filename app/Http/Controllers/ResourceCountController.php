<?php

namespace App\Http\Controllers;

use App\Models\Gradient;
use App\Models\User;
use Illuminate\Http\Request;

class ResourceCountController extends Controller
{
    /**
     * Display the total for gradients.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalGradients()
    {
        return success(count(Gradient::all()->toArray()));
    }

    /**
    * Display the total for users.
    *
    * @return \Illuminate\Http\Response
    */
    public function totalUsers()
    {
        return success(count(User::all()->toArray()));
    }
}

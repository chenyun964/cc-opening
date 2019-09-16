<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Click;

class ClickController extends Controller
{
    public function click()
    {
        $click = new Click();
        $click->save();
        return Click::count();
    }
}

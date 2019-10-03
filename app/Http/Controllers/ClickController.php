<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Click;

class ClickController extends Controller
{
    public function list()
    {
      $list = Click::orderBy('updated_at', 'desc')->first();
      if(!$list || $list->clicks == 11){
        $click = new Click();
        $click->save();
        $new_list = Click::orderBy('updated_at', 'desc')->first();
        return response()->json(['list' => $new_list]);
      }
      return response()->json(['list' => $list]);
    }

    public function clicked()
    {
        $old_click = Click::orderBy('updated_at', 'desc')->first();
        $click = new Click();
        if($old_click->clicks < $old_click->total) {
          $click->clicks = $old_click->clicks + 1;
        }
        $click->save();
        return response()->json(['list' => $click]);
    }

    public function reset()
    {
      $clicks = Click::get();
      foreach ($clicks as $key => $click) {
        $click->delete();
      }
      $new_clicks = Click::get();
      return $new_clicks;
    }
}

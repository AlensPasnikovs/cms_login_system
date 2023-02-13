<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;

class ThemeController extends Controller {
   public function update(Request $request) {
      $theme = $request->theme;
      $cookie = cookie('theme', $theme, 60 * 24 * 30);
      return response()->json(['data' => 'Theme saved successfully'])->cookie($cookie);
   }
}
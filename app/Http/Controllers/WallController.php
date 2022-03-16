<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Wall;
use App\Models\WallLike;

class WallController extends Controller
{
    public function getAll()
    {
        $array = [
            'error' => '',
            'list' => []
        ];

        $user = auth()->user();
        $walls = Wall::all();

        foreach ($walls as $wallkey => $wallValue) {
            $walls[$wallkey]['likes'] = 0;
            $walls[$wallkey]['liked'] = false;

            $likes = WallLikes::where('id_wall', $wallValue);
        }

        $array['list'] = $walls;
        return $array;
    }
}

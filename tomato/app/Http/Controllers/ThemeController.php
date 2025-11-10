<?php

namespace App\Http\Controllers;

use App\Http\Resources\Theme\ThemeResource;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThemeController extends Controller
{
    public function index()
    {
        return ThemeResource::collection(Theme::all())->resolve();
    }

    public function show(Theme $theme)
    {
        return ThemeResource::make($theme)->resolve();
    }

    public function store()
    {
        $theme = Theme::create([
            'title' => 'Wow title for theme from controller',
        ]);
        return $theme;
    }

    public function update(Theme $theme)
    {
        $theme->update(['title' => 'New Title']);
    }

    public function destroy(Theme $theme){
        $theme->delete();
        return response(['message' => 'Theme destroyed'], Response::HTTP_OK);
    }
}

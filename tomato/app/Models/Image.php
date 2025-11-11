<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Storage;

class Image extends Model
{

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrlAttribute() : string
//        кастомный аттрибут img_url
    {
        return Storage::disk('public')->url($this->path);
    }
}

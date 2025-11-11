<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Response;
use Storage;

class ImageController extends Controller
{
    public function destroy(Image $image)
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return response()->json([
            'message' => 'Image deleted successfully'
        ], Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DownloadMediaController extends Controller
{
    //
    public function show(Media $mediaItem)
    {
        // return response()->download($mediaItem->getPath(), $mediaItem->file_name);
        $originalName = $mediaItem->getCustomProperty('original_name');

        // If 'original_name' is not set, fallback to the media file name
        if (!$originalName) {
            $originalName = $mediaItem->file_name;
        }

        return response()->download($mediaItem->getPath(), $originalName);
    }
}

<?php

namespace App\Repositories\Uploads;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;

class ImagesRepository
{
    public function uploadPublicImage(Request $request)
    {
        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('series_cover', 'public')
            : null;

        return $coverPath;

    }
}

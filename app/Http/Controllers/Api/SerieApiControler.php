<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Seasons;
use App\Models\Series;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\Uploads\ImagesRepository;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;

class SerieApiControler extends Controller
{
    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has('name')){
            $query->where('name', $request->name);
        }

        return $query->paginate(2);

    }
    public function uploadImage(Request $request)
    {
        $coverPath = new ImagesRepository();

        $filePath = $coverPath->uploadPublicImage($request);

        return response()->json(['file_path' => $filePath]);
    }

    public function store(SeriesFormRequest $request)
    {
         return response(Series::create($request->all()), 201);

    }

    public function show(int $series)
    {
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if ($seriesModel === null){
            return response()->json(['message' => 'Series not found'], 404);
        }
        return $seriesModel;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        Series::where('id', $series)->update($request->all());
    }

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }


}

<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Seasons;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request) : Series
    {
        return DB::transaction(function () use ($request) {
            $serie = Series::create([
                'name' => $request->name,
                'cover' => $request->coverPath,
            ]);

            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            Seasons::insert($seasons);

            $episode = [];
            foreach ($serie->seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episode[] = [
                        'series_id' => $serie->id,
                        'seasons_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episode);

            return $serie;
        });
    }

    public function update(Series $series, SeriesFormRequest $request){

        $series->name = $request->name;
        $series->save();

        return DB::transaction(function () use ($series, $request) {

            DB::table('seasons')
                ->where('series_id', $series->id)
            ->delete();

            DB::table('episode')
                ->where('series_id', $series->id)
                ->delete();

            for ($i = 0; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i,
                ];
            }
            Seasons::insert($seasons);

            $seasons = Seasons::where('series_id', $series->id)
                ->get();

            $episode = [];
            foreach ($seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episode[] = [
                        'series_id' => $series->id,
                        'seasons_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episode);

            return $series;

        });
    }
}

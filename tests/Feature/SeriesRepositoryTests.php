<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTests extends TestCase
{

    public function test_series_if_seasons_and_episodes_are_created_to(): void
    {
        $repository = $this->app->make(SeriesRepository::class);
        $request = new SeriesFormRequest();
        $request->name = 'Nome da Série';
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;

        $repository->add($request);

        $this->assertDatabaseHas('series' ,['nome' => 'Nome da serie']);
        $this->assertDatabaseHas('seasons' ,['number' => 'Nome da serie']);
        $this->assertDatabaseHas('episodes' ,['number' => 'Nome da serie']);
    }
}

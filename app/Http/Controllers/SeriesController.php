<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Jobs\DeleteThumb;
use App\Mail\SeriesCreated;
use App\Models\Seasons;
use App\Models\Series;
use App\Models\User;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\Uploads\ImagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class SeriesController extends Controller
{
    public function __construct(
        private EloquentSeriesRepository $repository,
        private ImagesRepository $imagesRepository
    )
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');
        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $coverPath = $this->imagesRepository->uploadPublicImage($request);

        $request->coverPath = $coverPath;

        $series = $this->repository->add($request);

        \App\Events\SeriesCreated::dispatch(
          $series->name,
          $series->id,
          $request->seasonsQty,
          $request->episodesPerSeason
        );

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->name}' adicionada com sucesso");
    }

    public function destroy(Series $series, Request $request)
    {
        $coverPath = $series['cover'];

        if ($coverPath != null){
            DeleteThumb::dispatch($coverPath);
        }

        $series->delete();

        $request->session()->flash('mensagem.sucesso', "Série {$series->name} removida com sucesso");

        return to_route('series.index');
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {

        $this->repository->update($series,$request);


        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$series->name} atualizada com sucesso");
    }

}

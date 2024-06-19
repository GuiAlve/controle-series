<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Seasons;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EpisodesController
{

    public function index(Seasons $seasons)
    {
        return view('episode.index', [
            'episode' => $seasons->episode,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request)
    {
        $season_id = $request->season;

        if (!is_array($request->episode)){
            DB::table('episode')->where('seasons_id', $season_id)->update(['watched' => '0']);
            return to_route('episode.index', $season_id)
                ->with('mensagem.sucesso', 'Episodios marcados como assistidos');
        }

        $watchedEpisodes = implode(', ', $request->episode ?? []);

        DB::transaction(function () use ($watchedEpisodes, $season_id) {
            DB::table('episode')->where('seasons_id', $season_id)
                ->update(['watched' => DB::raw("case when id in ($watchedEpisodes) then 1 else 0 end")]);
        });


        return to_route('episode.index', $season_id)
            ->with('mensagem.sucesso', 'Episodios marcados como assistidos');

    }



}

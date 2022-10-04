<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();

        return view('albums.index', [
            'albums' => $albums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create', [
            "artists" => $this->artists()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $album = new Album();
        $album->artist = $request->artist;
        $album->title = $request->title;
        $album->year = $request->year;
        $album->save();

        return redirect()->route('album.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::where('id', $id)->first();

        return view('albums.edit', [
            'album' => $album,
            "artists" => $this->artists()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $album = Album::where('id', $id)->first();
        $album->artist = $request->artist;
        $album->title = $request->title;
        $album->year = $request->year;
        $album->save();

        return redirect()->route('album.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('Deletar Álbum')){
            throw new UnauthorizedException("You do not have permission to remove this album", "403");
        }

        $album = Album::where('id', $id)->first();
        if($album){
            $album->delete();
        }

        return redirect()->route('album.index');
    }

    private function artists(){
        $response = (new \GuzzleHttp\Client)->get("https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller", [
            "headers" => [
                "Authorization" => "Basic ZGV2ZWxvcGVyOlpHVjJaV3h2Y0dWeQ=="
            ]
        ]);

        $listOfArtists = json_decode($response->getBody()->getContents(), true)['json'];

        $artists = [];

        foreach ($listOfArtists as $artist){
            $artists[] = $artist[0];
        }

        return $artists;
    }
}

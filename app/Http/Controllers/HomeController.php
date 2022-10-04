<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            "artists" => $this->artists()
        ]);
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

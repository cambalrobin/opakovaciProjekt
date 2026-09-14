<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Race;
use App\Models\RaceYear;
use App\Models\Result;
use App\Models\Stage;

class Main extends BaseController
{
    public function index()
{
    $raceModel = new Race();
    $racesWithYears = $raceModel->select('race.*, race_year.*')
                            ->join('race_year', 'race_year.id_race = race.id')
                            ->where('race.id', 124)
                            ->orderBy('race_year.year', 'DESC')
                            ->findAll();

    $data = [
        'racesWithYears' => $racesWithYears
    ];

    echo view("uvodnistranka", $data);
}
}

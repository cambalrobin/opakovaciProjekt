<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\Race;
use App\Models\Stage; // Nezapomeň importovat i model Stage, pokud ho tam ještě nemáš
 
class Main extends BaseController
{
    public function index()
    {
        $raceModel = new Race();
        $stageModel = new Stage(); // Inicializace modelu etap
 
        // 1. Výpis ročníků (Tento dotaz ti už funguje)
        $years = $raceModel->builder('race_year')
                           ->select('
                                cyklo_race_year.id,
                                cyklo_race_year.year,
                                cyklo_race_year.start_date,
                                cyklo_race_year.end_date,
                                cyklo_race_year.real_name,
                                ROUND(SUM(cyklo_stage.distance)) as total_distance
                           ')
                           ->join('cyklo_stage', 'cyklo_stage.id_race_year = cyklo_race_year.id', 'left')
                           ->where('cyklo_race_year.id_race', 124)
                           ->groupBy('
                                cyklo_race_year.id,
                                cyklo_race_year.year,
                                cyklo_race_year.start_date,
                                cyklo_race_year.end_date,
                                cyklo_race_year.real_name
                           ')
                           ->orderBy('cyklo_race_year.year', 'DESC')
                           ->get()
                           ->getResult();
 
        // 2. PŘIDÁNO: Pro každý načtený ročník vytáhneme jeho etapy
        foreach ($years as &$year) {
            $year->stages = $stageModel->builder('stage')
                                       ->select('cyklo_stage.*')
                                       ->where('cyklo_stage.id_race_year', $year->id)
                                       ->orderBy('cyklo_stage.number', 'ASC') // Seřazeno vzestupně podle pořadí etapy
                                       ->get()
                                       ->getResult();
        }
 
        $data = [
            'years' => $years
        ];
 
        return view("uvodniStranka", $data);
    }
}
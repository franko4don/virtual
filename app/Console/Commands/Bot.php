<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Score;
use App\Team;

class Bot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets score of virtual matches and persists data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $init = curl_init(); 
        curl_setopt($init,CURLOPT_URL,"https://www.merrybet.com/vflbb/timeline.php?lang=en&clientid=371&screen=vleague&_=1465515246471");
        curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($init,CURLOPT_HEADER, false); 
        $response = curl_exec($init);
        curl_close($init);
        $result = json_decode($response,true);
        $current_season_id = $result['season_id'];
        $current_match_day = $result['matchday'];
        $score = Score::latest()->first();
            

        if(is_null($score)){
            for($i = 1; $i < $current_match_day; $i++){
                $init = curl_init(); 
                curl_setopt($init,CURLOPT_URL,"https://vfl3.betradar.com/vfl/feeds/?/merrybetvfl/en/Europe:Paris/gismo/vfl_event_fullfeed/$current_season_id/$i");
                curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($init,CURLOPT_HEADER, false); 
                $response = curl_exec($init);
                curl_close($init);
                $result = json_decode($response,true);
                $entry1 = $result['doc'][0]['data'];
                foreach($entry1 as $key1 => $firstvalue){
                    $entry2 = $firstvalue['realcategories']['800']['tournaments'];
                    foreach($entry2 as $key2 => $secondvalue){
                        $entry3 = $secondvalue['matches'];
                        foreach($entry3 as $key3 => $thirdvalue){
                            $record = new Score;
                            $record->home_id = $thirdvalue['teams']['home']['_id'];
                            $record->away_id = $thirdvalue['teams']['away']['_id'];
                            $record->home_score = $thirdvalue['result']['home'];
                            $record->away_score = $thirdvalue['result']['away'];
                            $record->season_id = $current_season_id;
                            $record->match_day = $i;
                            $record->save();
                        }
                    }
                    
                }
            }
        }else{
            if ($score->season_id !== $current_season_id && $score->match_day == 30){
                for($i = 1; $i < $current_match_day; $i++){
                    $init = curl_init(); 
                    curl_setopt($init,CURLOPT_URL,"https://vfl3.betradar.com/vfl/feeds/?/merrybetvfl/en/Europe:Paris/gismo/vfl_event_fullfeed/$current_season_id/$i");
                    curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($init,CURLOPT_HEADER, false); 
                    $response = curl_exec($init);
                    curl_close($init);
                    $result = json_decode($response,true);
                    $entry1 = $result['doc'][0]['data'];
                    foreach($entry1 as $key1 => $firstvalue){
                        $entry2 = $firstvalue['realcategories']['800']['tournaments'];
                        foreach($entry2 as $key2 => $secondvalue){
                            $entry3 = $secondvalue['matches'];
                            foreach($entry3 as $key3 => $thirdvalue){
                                $record = new Score;
                                $record->home_id = $thirdvalue['teams']['home']['_id'];
                                $record->away_id = $thirdvalue['teams']['away']['_id'];
                                $record->home_score = $thirdvalue['result']['home'];
                                $record->away_score = $thirdvalue['result']['away'];
                                $record->season_id = $current_season_id;
                                $record->match_day = $i;
                                $record->save();
                            }
                        }
                        
                    }
                }
            }

            if ($score->match_day < $current_match_day && $score->season_id == $current_season_id){
                for($i = $score->match_day + 1; $i < $current_match_day; $i++){
                    $init = curl_init(); 
                    curl_setopt($init,CURLOPT_URL,"https://vfl3.betradar.com/vfl/feeds/?/merrybetvfl/en/Europe:Paris/gismo/vfl_event_fullfeed/$current_season_id/$i");
                    curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($init,CURLOPT_HEADER, false); 
                    $response = curl_exec($init);
                    curl_close($init);
                    $result = json_decode($response,true);
                    $entry1 = $result['doc'][0]['data'];
                    foreach($entry1 as $key1 => $firstvalue){
                        $entry2 = $firstvalue['realcategories']['800']['tournaments'];
                        foreach($entry2 as $key2 => $secondvalue){
                            $entry3 = $secondvalue['matches'];
                            foreach($entry3 as $key3 => $thirdvalue){
                                $record = new Score;
                                $record->home_id = $thirdvalue['teams']['home']['_id'];
                                $record->away_id = $thirdvalue['teams']['away']['_id'];
                                $record->home_score = $thirdvalue['result']['home'];
                                $record->away_score = $thirdvalue['result']['away'];
                                $record->season_id = $current_season_id;
                                $record->match_day = $i;
                                $record->save();
                            }
                        }
                        
                    }
                }
            }

            if($score->season_id !== $current_season_id && $score->match_day == 29){
                $init = curl_init(); 
                curl_setopt($init,CURLOPT_URL,"https://vfl3.betradar.com/vfl/feeds/?/merrybetvfl/en/Europe:Paris/gismo/vfl_event_fullfeed/$score->season_id/30");
                curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($init,CURLOPT_HEADER, false); 
                $response = curl_exec($init);
                curl_close($init);
                $result = json_decode($response,true);
                $entry1 = $result['doc'][0]['data'];
                foreach($entry1 as $key1 => $firstvalue){
                    $entry2 = $firstvalue['realcategories']['800']['tournaments'];
                    foreach($entry2 as $key2 => $secondvalue){
                        $entry3 = $secondvalue['matches'];
                        foreach($entry3 as $key3 => $thirdvalue){
                            $record = new Score;
                            $record->home_id = $thirdvalue['teams']['home']['_id'];
                            $record->away_id = $thirdvalue['teams']['away']['_id'];
                            $record->home_score = $thirdvalue['result']['home'];
                            $record->away_score = $thirdvalue['result']['away'];
                            $record->season_id = $score->season_id;
                            $record->match_day = 30;
                            $record->save();
                        }
                    }
                    
                }
            }
        }
    }
}

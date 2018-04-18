<?php
use App\User;
use App\Score;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $users = User::all();
    return view('welcome',compact('users'));
});

Route::get('/curl', function () {
        $init = curl_init(); 
        curl_setopt($init,CURLOPT_URL,"https://www.merrybet.com/vflbb/timeline.php?lang=en&clientid=371&screen=vleague&_=1465515246471");
        curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($init,CURLOPT_HEADER, false); 
        $response = curl_exec($init);
        curl_close($init);
        $result = json_decode($response,true);
        // dd($result);
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
                    // dd($result);
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

            if ($score->match_day < $current_match_day && $score->season_id != $current_season_id){
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
        
        
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

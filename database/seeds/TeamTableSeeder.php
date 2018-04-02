<?php

use Illuminate\Database\Seeder;
use App\Team;
use \Carbon\Carbon;
class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Team::truncate();
        $data = [
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Markudi' , 'team_id' => 5804791, 'team_uuid' => 53411],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Warri', 'team_id' => 580478, 'team_uuid' => 53399],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Ibadan', 'team_id' => 5804785, 'team_uuid' => 53387],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Abuja Stars', 'team_id' => 5804778, 'team_uuid' => 53389],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Sagamu', 'team_id' => 5804784, 'team_uuid' => 53395],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Lagos Stars', 'team_id' => 5804787, 'team_uuid' => 53405],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Kaduna', 'team_id' => 5804786, 'team_uuid' => 53401],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Akure', 'team_id' => 5804795, 'team_uuid' => 53413],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Aba', 'team_id' => 5804788, 'team_uuid' => 53403],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Owerri', 'team_id' => 5804790, 'team_uuid' => 53409],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Ilorin', 'team_id' => 5804796, 'team_uuid' => 53415],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Calabar', 'team_id' => 5804781, 'team_uuid' => 53417],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Uyo', 'team_id' => 5804780, 'team_uuid' => 53393],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Enugu', 'team_id' => 5804779, 'team_uuid' => 53391],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Benin', 'team_id' => 5804783, 'team_uuid' => 53397],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'team_name' => 'VFL Kano', 'team_id' => 5804789, 'team_uuid' => 53407],       
        ];
        Team::insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

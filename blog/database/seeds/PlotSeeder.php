<?php

use Illuminate\Database\Seeder;
use App\Plot;

class PlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plot_seed = [
            ['id'=>'1','team_leader'=>'HARRY KIMON','record_by'=>'VALENTINE APIL','date_record'=>'2021-10-16',
            'start_time'=>'12:30:00','end_time'=>'12:48:00','total_team'=>'4',
            'plot_name'=>'TT-1-20211016-1A','location'=>'CROCKER RANGE',
            'latitude'=>'5.85537','longitude'=>'116.38382',
            'avg_slope'=>'35.5','strata_type'=>'Lower Montane Forest','gps_accuracy'=>'5',
            'resam'=>'10','typography'=>'3','elevation'=>'1164'],

            ['id'=>'2','team_leader'=>'HARRY KIMON','record_by'=>'VALENTINE APIL','date_record'=>'2021-10-16',
            'start_time'=>'13:05:00','end_time'=>'13:19:00','total_team'=>'4',
            'plot_name'=>'TT-1-20211016-1B','location'=>'CROCKER RANGE',
            'latitude'=>'5.8559','longitude'=>'116.38317',
            'avg_slope'=>'29.5','strata_type'=>'Lower Montane Forest','gps_accuracy'=>'4',
            'resam'=>'10','typography'=>'3','elevation'=>'1145'],

            ['id'=>'3','team_leader'=>'HARRY KIMON','record_by'=>'VALENTINE APIL','date_record'=>'2021-10-16',
            'start_time'=>'13:39:00','end_time'=>'13:59:00','total_team'=>'4', 
            'plot_name'=>'TT-1-20211016-1C','location'=>'CROCKER RANGE',
            'latitude'=>'5.85646','longitude'=>'116.38252',
            'avg_slope'=>'15','strata_type'=>'Lower Montane Forest','gps_accuracy'=>'7',
            'resam'=>'10','typography'=>'3','elevation'=>'1137'],

            ['id'=>'4','team_leader'=>'HARRY KIMON','record_by'=>'VALENTINE APIL','date_record'=>'2021-10-16',
            'start_time'=>'14:17:00','end_time'=>'14:43:00','total_team'=>'4', 
            'plot_name'=>'TT-1-20211016-1D','location'=>'CROCKER RANGE',
            'latitude'=>'5.85584','longitude'=>'116.38194',
            'avg_slope'=>'16','strata_type'=>'Lower Montane Forest','gps_accuracy'=>'5',
            'resam'=>'10','typography'=>'3','elevation'=>'1203'],
            
            ];

            foreach ($plot_seed as $plot_seed)
            {
                Plot::firstOrCreate($plot_seed);
            }
    }
}

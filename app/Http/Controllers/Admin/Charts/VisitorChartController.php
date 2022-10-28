<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * Class VisitorChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class VisitorChartController extends ChartController
{
    public function setup()
    {
        // FRappe Chart

        
        $this->chart = new Chart();
        // FAKE DATA Visitor Blog
        $this->chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $this->chart->dataset('Visitor Blog', 'line', [1, 2, 9, 4, 5, 6, 7, 8, 9, 10, 11, 12])
            ->color('rgba(205, 32, 31, 1)')
            ->backgroundColor('rgba(205, 32, 31, 0.4)');

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/visitor'));

        // OPTIONAL
        $this->chart->minimalist(false);
        $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {
        // $users_created_today = \App\User::whereDate('created_at', today())->count();

        // $this->chart->dataset('Users Created', 'bar', [
        //             $users_created_today,
        //         ])
        //     ->color('rgba(205, 32, 31, 1)')
        //     ->backgroundColor('rgba(205, 32, 31, 0.4)');

        // $this->chart->dataset = [
        //     'label' => 'Visitor Blog',
        //     'backgroundColor' => 'rgba(205, 32, 31, 0.4)',
        //     'borderColor' => 'rgba(205, 32, 31, 1)',
        //     'data' => [1, 2, 9, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        // ];
    }
}
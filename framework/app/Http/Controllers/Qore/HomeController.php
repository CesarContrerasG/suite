<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sentry\Master;
use App\Qore\Contract;
use App\Qore\Invoice;
use App\Qore\Pay;
use App\Qore\Details;
use App\Qore\Product;
use App\Qore\Company;
use App\Qore\Departament;
use App\User;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
        ->datasets([
            [
                "label" => "My First dataset",
                'backgroundColor' => "transparent",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [65, 59, 80, 81, 56, 55, 40],
            ],
            [
                "label" => "My Second dataset",
                'backgroundColor' => "transparent",
                'borderColor' => "rgba(142, 68, 173, 0.7)",
                "pointBorderColor" => "rgba(142, 68, 173, 0.7)",
                "pointBackgroundColor" => "rgba(142, 68, 173, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [12, 33, 44, 44, 55, 23, 40],
            ]
        ])
        ->options(
            [
                'legend' => [
                    'display' => false
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'display' => true,
                            'ticks' => [
                                'display' => false
                            ]
                        ]
                    ],
                    'yAxes' => [
                        [
                            'display' => true,
                            'ticks' => [
                                'display' => false
                            ]
                        ]
                    ]
                ]
            ]
        );

        $chartjs2 = app()->chartjs
        ->name('lineChartTest2')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
        ->datasets([
            [
                "label" => "My First dataset",
                'backgroundColor' => "transparent",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [65, 59, 80, 81, 56, 55, 40],
            ],
            [
                "label" => "My Second dataset",
                'backgroundColor' => "transparent",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [12, 33, 44, 44, 55, 23, 40],
            ]
        ])
        ->options(
            [
                'legend' => [
                    'display' => false
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'display' => true,
                            'ticks' => [
                                'display' => false
                            ]
                        ]
                    ],
                    'yAxes' => [
                        [
                            'display' => true,
                            'ticks' => [
                                'display' => false
                            ]
                        ]
                    ]
                ]
            ]
        );

        $chartjs3 = app()->chartjs
        ->name('lineChartTest3')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
        ->datasets([
            [
                "label" => "My First dataset",
                'backgroundColor' => "transparent",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [65, 59, 80, 81, 56, 55, 40],
            ],
            [
                "label" => "My Second dataset",
                'backgroundColor' => "transparent",
                'borderColor' => "rgba(54, 162, 235, 0.7)",
                "pointBorderColor" => "rgba(54, 162, 235, 0.7)",
                "pointBackgroundColor" => "rgba(54, 162, 235, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [12, 33, 44, 44, 55, 23, 40],
            ]
        ])
        ->options([
            'legend' => [
                'display' => false
            ],
            'scales' => [
                'xAxes' => [
                    [
                        'display' => true,
                        'ticks' => [
                            'display' => false
                        ]
                    ]
                ],
                'yAxes' => [
                    [
                        'display' => true,
                        'ticks' => [
                            'display' => false
                        ]
                    ]
                ]
            ]
        ]);

        /*
        $contracts = \Auth::user()->current_master->contracts->count();
        $billings = 0;
        foreach (\Auth::user()->current_master->contracts as $contract) {
            $billings += count($contract->billings);
        }

        $prospects = \Auth::user()->current_master->prospects;
        $providers = \Auth::user()->current_master->providers;
        $clients = \Auth::user()->current_master->clients;
        $users = \Auth::user()->current_master->company->users;

        $billings_year = \Auth::user()->current_master->annual_invoices;
        $billings_month = \Auth::user()->current_master->monthly_invoices;

        $data_chart_systems = \Auth::user()->current_master->pay_systems;
        $data_chart = \Auth::user()->current_master->pay_services;

        $chart_services_monthly = \Auth::user()->current_master->pay_services_monthly;
        $chart_systems_monthly = \Auth::user()->current_master->pay_systems_monthly;

        return view('Qore.index', compact('contracts', 'billings', 'prospects', 'providers', 'clients', 'users', 'billings_year', 'billings_month', 'collection_systems', 'data_chart', 'data_chart_systems', 'chart_services_monthly', 'chart_systems_monthly', 'storage', 'total_payment'));
        */
        $total_payment = Contract::totalPayment();

        return view('Qore.index')
            ->with([
                'chartjs' => $chartjs,
                'chartjs2' => $chartjs2,
                'chartjs3' => $chartjs3,
                'total_payment' => $total_payment
            ]);
    }

    public function admin()
    {
        $records = Master::companiesChart();
        $products = count(Product::getValidProducts());
        $departaments = count(auth()->user()->departaments);
        $users =  User::getUsersOfAccount(auth()->user()->current_master);

        $chartjs = app()->chartjs
            ->name('lineAdministrationQore')
            ->type('line')
            ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'])
            ->datasets([
                [
                    "label" => "Clientes",
                    'backgroundColor' => "rgba(66, 200, 138, 0.31)",
                    'borderColor' => "rgba(66, 200, 138, 0.7)",
                    "pointBorderColor" => "rgba(66, 200, 138, 0.7)",
                    "pointBackgroundColor" => "rgba(66, 200, 138, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$records['clients'][1],
                        $records['clients'][2],
                        $records['clients'][3],
                        $records['clients'][4],
                        $records['clients'][5],
                        $records['clients'][6],
                        $records['clients'][7],
                        $records['clients'][8],
                        $records['clients'][9],
                        $records['clients'][10],
                        $records['clients'][11],
                        $records['clients'][12]
                    ],
                ],
                [
                    "label" => "Proveedores",
                    'backgroundColor' => "rgba(15, 143, 83, 0.31)",
                    'borderColor' => "rgba(15, 143, 83, 0.7)",
                    "pointBorderColor" => "rgba(15, 143, 83, 0.7)",
                    "pointBackgroundColor" => "rgba(15, 143, 83, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$records['providers'][1],
                        $records['providers'][2],
                        $records['providers'][3],
                        $records['providers'][4],
                        $records['providers'][5],
                        $records['providers'][6],
                        $records['providers'][7],
                        $records['providers'][8],
                        $records['providers'][9],
                        $records['providers'][10],
                        $records['providers'][11],
                        $records['providers'][12]],
                ],
                [
                    "label" => "Prospectos",
                    'backgroundColor' => "rgba(52, 73, 94, 0.31)",
                    'borderColor' => "rgba(52, 73, 94, 0.7)",
                    "pointBorderColor" => "rgba(52, 73, 94, 0.7)",
                    "pointBackgroundColor" => "rgba(52, 73, 94, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$records['prospects'][1],
                        $records['prospects'][2],
                        $records['prospects'][3],
                        $records['prospects'][4],
                        $records['prospects'][5],
                        $records['prospects'][6],
                        $records['prospects'][7],
                        $records['prospects'][8],
                        $records['prospects'][9],
                        $records['prospects'][10],
                        $records['prospects'][11],
                        $records['prospects'][12]],
                ]
            ])
            ->options([]);
        return view('Qore.administration', compact('chartjs', 'products', 'departaments', 'users'));
    }

    public function accounts()
    {
        /*

        */

        $results = Master::panelAccount();
        $contracts = $results['contracts'];
        $to_start = $results['to_start'];
        $to_close = $results['to_close'];
        $total_payment = $results['total_payment'];

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->labels(['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'])
            ->datasets([
                [
                    "label" => "Contratos",
                    'backgroundColor' => [
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)',
                        'rgba(42, 178, 123, 0.4)'
                    ],
                    'data' => [
                        $contracts[1],
                        $contracts[2],
                        $contracts[3],
                        $contracts[4],
                        $contracts[5],
                        $contracts[6],
                        $contracts[7],
                        $contracts[8],
                        $contracts[9],
                        $contracts[10],
                        $contracts[11],
                        $contracts[12]
                    ]
                ]
            ])
            ->options([]);

        return view('Qore.accounts', compact('chartjs', 'to_start', 'to_close', 'total_payment'));
    }
}

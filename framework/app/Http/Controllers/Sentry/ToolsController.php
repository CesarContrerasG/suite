<?php

namespace App\Http\Controllers\Sentry;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Http\Controllers\Controller;
use App\User;
use App\Activity;
use App\Sentry\Analytics;
use App\Sentry\Security;
use App\Sentry\Module;
use App\Sentry\Type;
use Carbon\Carbon;

use Validator;

class ToolsController extends Controller
{
    public function index()
    {
        return view('Sentry.tools.index');
    }

    public function indexActivities()
    {
        $users = User::all();
        return view('Sentry.tools.activities.index', compact('users'));
    }

    public function showActivities(User $user)
    {
        $chartjs = Activity::chartUserActivities($user);       
        return view('Sentry.tools.activities.show', compact('user', 'chartjs'));
    }

    public function getRecords(User $user)
    {
        $records = Activity::where('user_id', $user->id)
            ->select('id', 'action', 'model_class', 'model_id', 'created_at');
        return Datatables::of($records)->make(true);
    }

    public function security()
    {
        return view('Sentry.tools.security.index');
    }

    public function usersSecurity()
    {
        $users = User::all();
        return view('Sentry.tools.security.users', compact('users'));
    }

    public function userAuthorize(User $authorized)
    {
        if(Security::toggleAuthorize($authorized))
        {
            return redirect()->route('sentry.security.users'); 
        }
        return redirect()->back();
    }

    public function privileges()
    {
        $modules = Module::all();
        $nivels = Type::all();
        return view('Sentry.tools.security.privileges', compact('modules', 'nivels'));
    }

    public function setPrivileges(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'module_id' => 'required|integer|min:1',
            'type_id' => 'required|integer|min:1'
        ]);

        if($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos recibidos']);
        }

        $module =  $request->get('module_id');
        $type =  $request->get('type_id');
        $date = Carbon::now();
        
        if(Module::addUserType($module, $type, $date) == true){
            return response()->json(['message' => "Module: {$module}, Type: {$type}"]);
        }

    }

    public function databases()
    {
        return view('Sentry.tools.databases.index');
    }

    public function analytics()
    {
        /**
         * 
         */    
        $dataActivitiesAnnual = Analytics::getChartDataset("activity", 12);
        $chartActivitiesAnnual = Analytics::buildChart('line', 'chartActivitiesAnnual', $dataActivitiesAnnual["labels"], $dataActivitiesAnnual["data"], "Operaciones", "38, 185, 154");
        $dataActivitiesBiannual = Analytics::getChartDataset("activity", 6);
        $chartActivitiesBiannual = Analytics::buildChart('bar', 'chartActivitiesBiannual', $dataActivitiesBiannual["labels"], $dataActivitiesBiannual["data"], "Operaciones", "155, 89, 182");
        $dataActivitiesQuarterly = Analytics::getChartDataset("activity", 3);
        $chartActivitiesQuarterly = Analytics::buildChart('bar', 'chartActivitiesQuarterly', $dataActivitiesQuarterly["labels"], $dataActivitiesQuarterly["data"], "Operaciones", "255,99,132");

        $rate_anual_activities = Analytics::getGrowthRateAnual("activity");
        $rate_biannual_activities = Analytics::getGrowthRateBiannual("activity");
        $rate_quarterly_activities = Analytics::getGrowthRateQuarterly("activity");
        /**
         * 
         */ 
        $dataCompaniesAnnual = Analytics::getChartDataset("company", 12);
        $chartCompaniesAnnual = Analytics::buildChart('line', 'chartCompaniesAnnual', $dataCompaniesAnnual["labels"], $dataCompaniesAnnual["data"], "Empresas", "155, 89, 182");
        $dataCompaniesBiannual = Analytics::getChartDataset("company", 6);
        $chartCompaniesBiannual = Analytics::buildChart('bar', 'chartCompaniesBiannual', $dataCompaniesBiannual["labels"], $dataCompaniesBiannual["data"], "Empresas", "52, 152, 219");
        $dataCompaniesQuarterly = Analytics::getChartDataset("company", 3);
        $chartCompaniesQuarterly = Analytics::buildChart('bar', 'chartCompaniesQuarterly', $dataCompaniesQuarterly["labels"], $dataCompaniesQuarterly["data"], "Empresas", "236, 240, 241");

        $rate_anual_companies = Analytics::getGrowthRateAnual("company");
        $rate_biannual_companies = Analytics::getGrowthRateBiannual("company");
        $rate_quarterly_companies = Analytics::getGrowthRateQuarterly("company");
        /**
         * 
         */
        $dataUsersAnnual = Analytics::getChartDataset("user", 12);
        $chartUsersAnnual = Analytics::buildChart('line', 'chartUsersAnnual', $dataUsersAnnual["labels"], $dataUsersAnnual["data"], "Usuarios", "243, 156, 18");
        $dataUserBiannual = Analytics::getChartDataset("user", 6);
        $chartUsersBiannual = Analytics::buildChart('bar', 'chartUsersBiannual', $dataUserBiannual["labels"], $dataUserBiannual["data"], "Usuarios", "46, 204, 113");
        $dataUserQuarterly = Analytics::getChartDataset("user", 3);
        $chartUsersQuarterly = Analytics::buildChart('bar', 'chartUsersQuarterly', $dataUserQuarterly["labels"], $dataUserQuarterly["data"], "Usuarios", "240, 98, 146");

        $rate_anual_users = Analytics::getGrowthRateAnual("user");
        $rate_biannual_users = Analytics::getGrowthRateBiannual("user");
        $rate_quarterly_users = Analytics::getGrowthRateQuarterly("user");


        return view('Sentry.tools.analytics.index', compact(
            'rate_anual_activities', 
            'rate_biannual_activities', 
            'rate_quarterly_activities',
            'chartActivitiesAnnual', 
            'chartActivitiesBiannual', 
            'chartActivitiesQuarterly',
            'rate_anual_companies', 
            'rate_biannual_companies', 
            'rate_quarterly_companies',
            'chartCompaniesAnnual', 
            'chartCompaniesBiannual', 
            'chartCompaniesQuarterly',
            'rate_anual_users', 
            'rate_biannual_users', 
            'rate_quarterly_users',
            'chartUsersAnnual', 
            'chartUsersBiannual', 
            'chartUsersQuarterly'));
    }
}

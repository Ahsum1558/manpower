<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Super;
use App\Models\Cmspage;
use App\Models\TravelCmspage;
use App\Models\Headerfooter;
use App\Models\TravelSetup;
use App\Models\Field;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class TravelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('travel.includes.header', function($view){
            $user = Auth::user();
            $travel_headers = $this->getData();
            $travel_meta_data = TravelCmspage::all();
            $view->with([
                'user' => $user,
                'travel_headers' => $travel_headers,
                'travel_meta_data' => $travel_meta_data,
            ]);
        });

        View::composer('travel.users.login', function($view){
            $travel_login_header = $this->getData();
            $travel_meta_data = TravelCmspage::all();
            $view->with([
                'travel_login_header' => $travel_login_header,
                'travel_meta_data' => $travel_meta_data,
            ]);
        });

        View::composer('travel.includes.footer', function($view){
            $travel_footers = $this->getData();
            $view->with('travel_footers', $travel_footers);
        });
    }

    protected function getData(){
        $data = DB::table('travel_setups')
            ->leftJoin('fields', 'travel_setups.field_id', '=', 'fields.id')
            ->select('travel_setups.*', 'fields.title', 'fields.smalltitle', 'fields.license', 'fields.address', 'fields.logo')
            ->get();
        return $data;
    }
}
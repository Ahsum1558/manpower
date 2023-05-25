<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Super;
use App\Models\Cmspage;
use App\Models\Headerfooter;
use App\Models\Field;
use File;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('super.includes.header', function($view){
            $super = Auth::guard('super')->user();
            $super_header = $this->getData();
            $meta_data = Cmspage::all();
            $view->with([
                'super' => $super,
                'super_header' => $super_header,
                'meta_data' => $meta_data,
            ]);
        });

        View::composer('super.users.login', function($view){
            $login_header = $this->getData();
            $meta_data = Cmspage::all();
            $view->with([
                'login_header' => $login_header,
                'meta_data' => $meta_data,
            ]);
        });

        View::composer('admin.includes.header', function($view){
            $user = Auth::user();
            $admin_headers = $this->getData();
            $admin_meta_data = Cmspage::all();
            $view->with([
                'user' => $user,
                'admin_headers' => $admin_headers,
                'admin_meta_data' => $admin_meta_data,
            ]);
        });

        View::composer('admin.users.login', function($view){
            $admin_login_header = $this->getData();
            $admin_meta_data = Cmspage::all();
            $view->with([
                'admin_login_header' => $admin_login_header,
                'admin_meta_data' => $admin_meta_data,
            ]);
        });

        View::composer('super.includes.footer', function($view){
            $footers = $this->getData();
            $view->with('footers', $footers);
        });

        View::composer('admin.includes.footer', function($view){
            $admin_footers = $this->getData();
            $view->with('admin_footers', $admin_footers);
        });
    }

    protected function getData(){
        $data = DB::table('headerfooters')
            ->leftJoin('fields', 'headerfooters.field_id', '=', 'fields.id')
            ->select('headerfooters.*', 'fields.title', 'fields.smalltitle', 'fields.license', 'fields.address', 'fields.logo')
            ->get();
        return $data;
    }
}

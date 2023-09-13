<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use App\Models\FooterSetting;
use App\Models\ProfileUser;
use App\Models\ProfileUserSkill;
use App\Models\Skill;
use App\Models\SmsSetting;
use App\Models\ThemeSetting;
use App\Models\User;
use Carbon\Carbon;
use Froiden\Envato\Traits\AppBoot;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,AppBoot;
    
    /**
     * @var array
     */
    public $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[ $name ]);
    }

    public function __construct() {
        $this->showInstall();
        $this->checkMigrateStatus();
        $this->global = CompanySetting::first();
        $this->smsSettings = SmsSetting::first();
        $this->companyName = $this->global->company_name;
        $this->calling_codes = $this->getCallingCodes();
        $this->degrees = $this->getDegrees();
        $this->adminTheme = ThemeSetting::latest('created_at')->first();
        $this->customPages = FooterSetting::where('status', 'active')->get();

        config(['app.name' => $this->global->company_name]);
        config(['app.url' => url('/')]);
        view()->share('smsSettings', $this->smsSettings);

        App::setLocale($this->global->locale);
        Carbon::setLocale($this->global->locale);
        setlocale(LC_TIME,$this->global->locale.'_'.strtoupper($this->global->locale));

        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if ($user) {
                config(['froiden_envato.allow_users_id' => true]);

                $this->user = User::find($user->id);
                $this->skill_data = Skill::all();
                $profile = ProfileUser::where('user_id', $this->user->id)->with(['educations', 'experiences', 'skills'])->first();
                $this->user->profile = $profile;
                if($profile){
                    $skills = ProfileUserSkill::where('profile_user_id', $profile->id)->get();
                    $this->user->profile->skills = $skills;
                }
            }
            return $next($request);
        });
    }
    public function checkMigrateStatus()
    {
        $status = Artisan::call('migrate:check');

        if ($status && !request()->ajax()) {
            Artisan::call('migrate', array('--force' => true)); //migrate database
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
        }
    }
    
    public function getCallingCodes()
    {
        $codes = [];
        foreach(config('calling_codes.codes') as $code) {
            $codes = Arr::add($codes, $code['code'], array('name' => $code['name'], 'dial_code' => $code['dial_code']));
        };
        return $codes;
    }

    public function getDegrees()
    {
        $degrees = [];
        foreach(config('degrees.degrees') as $degree) {
            array_push($degrees, $degree['name']);
        };
        return $degrees;
    }
}

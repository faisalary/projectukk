<?php

namespace App\Http\Controllers;

use App\ApplicationSetting;
use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicantProfile\StoreApplicantProfile;
use App\Http\Requests\ApplicantProfile\StoreEducations;
use App\Http\Requests\ApplicantProfile\StoreInformation;
use App\Http\Requests\ApplicantProfile\StoreLanguage;
use App\Http\Requests\ApplicantProfile\StorePersonal;
use App\Http\Requests\ApplicantProfile\StorePortfolio;
use App\Http\Requests\ApplicantProfile\StoreSkills;
use App\Http\Requests\ApplicantProfile\UpdateApplicantProfile;
use App\JobIndustry;
use App\JobLocation;
use App\MasterMajor;
use App\ProfileUser;
use App\ProfileUserEducation;
use App\ProfileUserExperience;
use App\ProfileUserInformation;
use App\ProfileUserLanguage;
use App\ProfileUserPortfolio;
use App\ProfileUserSkill;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProfileUserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.applicantProfile');
        $this->pageIcon = 'ti-user';
        $this->countriesArray = json_decode(file_get_contents(public_path('country-state-city/countries.json')), true)['countries'];
        $this->statesArray = json_decode(file_get_contents(public_path('country-state-city/states.json')), true)['states'];
        $this->skills = Skill::orderBy('name')->get();
        $this->majors = MasterMajor::orderBy('major')->get();
        $this->industries = JobIndustry::orderBy('name')->get();
        $this->locations = JobLocation::orderBy('location')->get();
        $this->language_names = json_decode(file_get_contents(public_path('/json/languages.json')), true)['results'];
        $this->gender = [
            'male' => __('modules.front.male'),
            'female' => __('modules.front.female')
            // 'others' => __('modules.front.others')
        ];
        
        $this->language_levels = [
            'Native / Bilingual Proficiency', 'Professional Working Proficiency', 'Limited Working Proficiency', 'Elementary Proficiency'
        ];
        
        $this->portfolios = [
            'LinkedIn', 'Portfolio', 'Website', 'Github', 'Gitlab', 'Behance', 'TikTok', 'Twitter', 'Instagram', 'Facebook', 'Other'
        ];
    }

    public function index()
    {
        $preferred_cities = json_decode($this->user->profile->information->preferred_city ?? '[]');
        return view('profile-user.setup', $this->data , compact('preferred_cities'));
    }

    public function edit()
    {
        $preferred_cities = json_decode($this->user->profile->information->preferred_city ?? '[]');

        return view('profile-user.index', $this->data, compact('preferred_cities'));
    }

    public function store(StoreApplicantProfile $request)
    {

        foreach ($request->salary as $key => $value) {
            $salary[] = str_replace(array('.', ','), '' , $value);
        }
        $expected_salary = str_replace(array('.', ','), '' , $request->expected_salary_value);
        
        $request->merge([
            'salary' => $salary,
            'expected_salary_value' => $expected_salary
        ]);
        if($request->has('user_id')){
            $user = User::find($request->user_id);
        }
        else{
            $user = Auth::user();
        }

        //update user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->calling_code = $request->calling_code;
        $user->mobile = $request->mobile;

        if ($request->hasFile('image')) {
            if($user->image){
                File::delete($user->profile_image_url);
            }
            $user->image = Files::upload($request->image, 'profile');
        }
        $user->save();

        //create profile user
        $profile = new ProfileUser();
        if($request->has('profile_user_id')){
            $profile_user_id = $request->profile_user_id;
            if($profile_user_id != null)
                $profile = ProfileUser::find($profile_user_id);
        }
        $profile->user_id = $user->id;
        $profile->headline = $request->headline;
        $profile->dob = $request->dob;
        $profile->marital_stat = $request->marital_stat;
        $profile->gender = $request->gender;
        $profile->nationality = $request->nationality;
        $countriesArray = json_decode(file_get_contents(public_path('country-state-city/countries.json')), true)['countries'];
        $statesArray = json_decode(file_get_contents(public_path('country-state-city/states.json')), true)['states'];
        $profile->country = $this->getName($countriesArray, $request->country);
        $profile->state = $this->getName($statesArray, $request->state);
        $profile->city = $request->city;
        $profile->postal_code = $request->postal_code;

        if ($request->has('cover_letter')) {
            $profile->cover_letter = $request->cover_letter;
        }

        $profile->save();

        //create profile user information
        $information = new ProfileUserInformation();
        if($request->has('information_id')){
            $information_id = $request->information_id;
            if($information_id != null)
                $information = ProfileUserInformation::find($information_id);
        }
        $information->profile_user_id = $profile->id;
        $information->expected_salary_type = $request->expected_salary_type;
        $information->expected_salary_value = $request->expected_salary_value;
        $information->preferred_city = json_encode($request->preferred_city);
        $information->save();

        //create profile user education
        if($request->has('education_id')){
            $education_ids = $request->input('education_id');
            $educations = ProfileUserEducation::where('profile_user_id', $profile->id)->get();
            foreach ($educations as $key => $education) {
                if (!in_array($education->id, $education_ids)) {
                    $education->delete();
                }
            }
        }
        if ($request->has('university')) {
            $universities = $request->input('university');
            $degrees = $request->input('degree');
            $studies = $request->input('study');
            $start_dates = $request->input('start_date');
            $gpas = $request->input('gpa');
            $is_graduateds = $request->input('is_graduated');
            if($request->has('end_date')){
                $end_dates = $request->input('end_date');
            }
            
            for ($i=0;$i<count($universities);$i++){
                if (trim($universities[$i]) != '' && trim($degrees[$i]) != '' &&
                    trim($studies[$i]) != '' && trim($start_dates[$i]) != '' &&
                    trim($gpas[$i]) != '' && trim($is_graduateds[$i]) != ''
                ){
                    $education = new ProfileUserEducation();
                    if($request->has('education_id')){
                        if($i < count($education_ids)){
                            if($education_ids[$i] != null)
                                $education = ProfileUserEducation::find($education_ids[$i]);
                        }
                    }
                    $education->profile_user_id = $profile->id;
                    $education->university = $universities[$i];
                    $education->degree = $degrees[$i];
                    $education->study = $studies[$i];
                    $education->start_date = $start_dates[$i];
                    $education->gpa = $gpas[$i];
                    $education->is_graduated = $is_graduateds[$i];
                    if(isset($end_dates[$i])){
                        $education->end_date = $end_dates[$i];
                    }
                    else{
                        $education->end_date = null;
                    }
                    $education->save();

                    // create major 
                    MasterMajor::where('major',$studies[$i])->firstOrCreate(['major'=>$studies[$i]]);
                }
            }
        }

        //create profile user skills
        $old_skills = ProfileUserSkill::where('profile_user_id', $profile->id)->get();
        foreach ($old_skills as $key => $skill) {
            $skill->delete();
        }
        if ($request->has('skills')) {
            $skills = $request->input('skills');
            
            for ($i=0;$i<count($skills);$i++){
                if (trim($skills[$i]) != ''){
                    $skill = new Skill();
                    if(Skill::where('name', 'LIKE', $skills[$i])->first()){
                        $skill = Skill::where('name', 'LIKE', $skills[$i])->first();
                    }
                    $skill->name = ucwords($skills[$i]);
                    $skill->save();

                    $profile_skill = new ProfileUserSkill();
                    $profile_skill->profile_user_id = $profile->id;
                    $profile_skill->skill_id = $skill->id;
                    $profile_skill->save();
                }
            }
        }

        if($request->has('experience_id')){
            $experience_ids = $request->input('experience_id');
            $experiences = ProfileUserExperience::where('profile_user_id', $profile->id)->get();
            foreach ($experiences as $key => $experience) {
                if (!in_array($experience->id, $experience_ids)) {
                    $experience->delete();
                }
            }
        }
        if ($request->has('start_period')) {
            $start_periods = $request->input('start_period');
            $end_periods = $request->input('end_period');
            $comps = $request->input('company');
            $positions = $request->input('position');
            $descriptions = $request->input('description');
            $industry_ids = $request->input('industry_id');
            $salaries = $request->input('salary');
            
            for ($i=0;$i<count($start_periods);$i++) {
                if (trim($start_periods[$i]) != '' && trim($comps[$i]) != '' && trim($positions[$i]) != '') {
                    $jobExp = new ProfileUserExperience();
                    if($request->has('experience_id')){
                        if($i < count($experience_ids)){
                            if($experience_ids[$i] != null)
                                $jobExp = ProfileUserExperience::find($experience_ids[$i]);
                        }
                    }
                    $jobExp->profile_user_id = $profile->id;
                    $jobExp->start_period = $start_periods[$i];
                    $jobExp->end_period = $end_periods[$i];
                    $jobExp->company = $comps[$i];
                    $jobExp->position = $positions[$i];
                    $jobExp->description = $descriptions[$i];
                    $jobExp->industry_id = $industry_ids[$i];
                    $jobExp->salary = $salaries[$i];
                    $jobExp->save();
                }
            }
        }

        if($request->has('language_id')){
            $language_ids = $request->input('language_id');
            $languages = ProfileUserLanguage::where('profile_user_id', $profile->id)->get();
            foreach ($languages as $key => $language) {
                if (!in_array($language->id, $language_ids)) {
                    $language->delete();
                }
            }
        }
        if ($request->has('language_name')) {
            $language_names = $request->input('language_name');
            $language_levels = $request->input('language_level');
            
            for ($i=0;$i<count($language_names);$i++) {
                if (trim($language_names[$i]) != '' && trim($language_levels[$i]) != '') {
                    $lang = new ProfileUserLanguage();
                    if($request->has('language_id')){
                        if($i < count($language_ids)){
                            if($language_ids[$i] != null)
                                $lang = ProfileUserLanguage::find($language_ids[$i]);
                        }
                    }
                    $lang->profile_user_id = $profile->id;
                    $lang->name = $language_names[$i];
                    $lang->level = $language_levels[$i];
                    $lang->save();
                }
            }
        }

        if($request->has('portfolio_id')){
            $portfolio_ids = $request->input('portfolio_id');
            $portfolios = ProfileUserPortfolio::where('profile_user_id', $profile->id)->get();
            foreach ($portfolios as $key => $portfolio) {
                if (!in_array($portfolio->id, $portfolio_ids)) {
                    $portfolio->delete();
                }
            }
        }
        if ($request->has('portfolio')) {
            $portfolios = $request->input('portfolio');
            $urls = $request->input('url');
            
            for ($i=0;$i<count($portfolios);$i++) {
                if (trim($portfolios[$i]) != '' && trim($urls[$i]) != '') {
                    $port = new ProfileUserPortfolio();
                    if($request->has('portfolio_id')){
                        if($i < count($portfolio_ids)){
                            if($portfolio_ids[$i] != null)
                                $port = ProfileUserPortfolio::find($portfolio_ids[$i]);
                        }
                    }
                    $port->profile_user_id = $profile->id;
                    $port->name = $portfolios[$i];
                    $port->url = $urls[$i];
                    $port->save();
                }
            }
        }

        if ($request->hasFile('resume')) {
            // Files::deleteFile($profile->resumeDocument->hashname, 'documents/users'.$profile->id);
            $hashname = Files::upload($request->resume, 'documents/users/'.$profile->id, null, null, false);
            $profile->documents()->updateOrCreate([
                'documentable_type' => ProfileUser::class,
                'documentable_id' => $profile->id,
                'name' => 'Resume'
            ],
            [
                'hashname' => $hashname
            ]);
        }

        //save all
        // DB::transaction(function () {
        //     DB::table('users')->update(['votes' => 1]);
         
        //     DB::table('posts')->delete();
        // });

        return Reply::redirect(route('profile.setup'), __('menu.applicantProfile') . ' ' . __('messages.createdSuccessfully'));
    }

    public function storePersonal(StorePersonal $request)
    {
        if($request->has('user_id')){
            $user = User::find($request->user_id);
        }
        else{
            $user = Auth::user();
        }

        //update user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->calling_code = $request->calling_code;
        $user->mobile = $request->mobile;

        if ($request->hasFile('image')) {
            if($user->image){
                File::delete($user->profile_image_url);
            }
            $user->image = Files::upload($request->image, 'profile');
        }
        $user->save();

        $profile_user_id = $request->profile_user_id;
        $profile = ProfileUser::find($profile_user_id);
        $profile->user_id = $user->id;
        $profile->headline = $request->headline;
        $profile->dob = $request->dob;
        $profile->marital_stat = $request->marital_stat;
        $profile->gender = $request->gender;
        $profile->nationality = $request->nationality;
        $countriesArray = json_decode(file_get_contents(public_path('country-state-city/countries.json')), true)['countries'];
        $statesArray = json_decode(file_get_contents(public_path('country-state-city/states.json')), true)['states'];
        $profile->country = $this->getName($countriesArray, $request->country);
        $profile->state = $this->getName($statesArray, $request->state);
        $profile->city = $request->city;
        $profile->postal_code = $request->postal_code;

        if ($request->has('cover_letter')) {
            $profile->cover_letter = $request->cover_letter;
        }

        $profile->save();

        //save all
        // DB::transaction(function () {
        //     DB::table('users')->update(['votes' => 1]);
         
        //     DB::table('posts')->delete();
        // });

        return Reply::redirect(route('profile.index'), __('menu.applicantProfile') . ' ' . __('messages.createdSuccessfully'));
    }

    public function storeInformation(StoreInformation $request)
    {
        $profile_user_id = $request->profile_user_id;
        $profile = ProfileUser::find($profile_user_id);

        $preferred_city = json_encode($request->preferred_city);
        $expected_salary = str_replace(array('.', ','), '' , $request->expected_salary_value);
        
        $request->merge([
            'expected_salary_value' => $expected_salary
        ]);

        //create profile user information
        $information = new ProfileUserInformation();
        if($request->has('information_id')){
            $information_id = $request->information_id;
            if($information_id != null)
                $information = ProfileUserInformation::find($information_id);
        }
        $information->profile_user_id = $profile->id;
        $information->expected_salary_type = $request->expected_salary_type;
        $information->expected_salary_value = $request->expected_salary_value;
        $information->preferred_city = $preferred_city;
        $information->save();

        return Reply::redirect(route('profile.information'), __('menu.applicantProfile') . ' ' . __('messages.createdSuccessfully'));
    }

    public function storeEducations(StoreEducations $request)
    {
        $profile_user_id = $request->profile_user_id;
        $profile = ProfileUser::find($profile_user_id);

        //create profile user education
        if($request->has('education_id')){
            $education_ids = $request->input('education_id');
            $educations = ProfileUserEducation::where('profile_user_id', $profile->id)->get();
            foreach ($educations as $key => $education) {
                if (!in_array($education->id, $education_ids)) {
                    $education->delete();
                }
            }
        }
        if ($request->has('university')) {
            $universities = $request->input('university');
            $degrees = $request->input('degree');
            $studies = $request->input('study');
            $start_dates = $request->input('start_date');
            $gpas = $request->input('gpa');
            $is_graduateds = $request->input('is_graduated');
            if($request->has('end_date')){
                $end_dates = $request->input('end_date');
            }
            
            for ($i=0;$i<count($universities);$i++){
                if (trim($universities[$i]) != '' && trim($degrees[$i]) != '' &&
                    trim($studies[$i]) != '' && trim($start_dates[$i]) != '' &&
                    trim($gpas[$i]) != '' && trim($is_graduateds[$i]) != ''
                ){
                    $education = new ProfileUserEducation();
                    if($request->has('education_id')){
                        if($i < count($education_ids)){
                            if($education_ids[$i] != null)
                                $education = ProfileUserEducation::find($education_ids[$i]);
                        }
                    }
                    $education->profile_user_id = $profile->id;
                    $education->university = $universities[$i];
                    $education->degree = $degrees[$i];
                    $education->study = $studies[$i];
                    $education->start_date = $start_dates[$i];
                    $education->gpa = $gpas[$i];
                    $education->is_graduated = $is_graduateds[$i];
                    if(isset($end_dates[$i])){
                        $education->end_date = $end_dates[$i];
                    }
                    else{
                        $education->end_date = null;
                    }
                    $education->save();

                    // create major 
                    MasterMajor::where('major',$studies[$i])->firstOrCreate(['major'=>$studies[$i]]);
                }
            }
        }

        //save all
        // DB::transaction(function () {
        //     DB::table('users')->update(['votes' => 1]);
         
        //     DB::table('posts')->delete();
        // });

        return Reply::redirect(route('profile.educations'), __('menu.applicantProfile') . ' ' . __('messages.createdSuccessfully'));
    }

    public function storeSkills(StoreSkills $request)
    {
        foreach ($request->salary as $key => $value) {
            $salary[] = str_replace(array('.', ','), '' , $value);
        }

        $request->merge([
            'salary' => $salary
        ]);

        $profile_user_id = $request->profile_user_id;
        $profile = ProfileUser::find($profile_user_id);

        //create profile user skills
        $old_skills = ProfileUserSkill::where('profile_user_id', $profile->id)->get();
        foreach ($old_skills as $key => $skill) {
            $skill->delete();
        }
        if ($request->has('skills')) {
            $skills = $request->input('skills');
            
            for ($i=0;$i<count($skills);$i++){
                if (trim($skills[$i]) != ''){
                    $skill = new Skill();
                    if(Skill::where('name', 'LIKE', $skills[$i])->first()){
                        $skill = Skill::where('name', 'LIKE', $skills[$i])->first();
                    }
                    $skill->name = ucwords($skills[$i]);
                    $skill->save();

                    $profile_skill = new ProfileUserSkill();
                    $profile_skill->profile_user_id = $profile->id;
                    $profile_skill->skill_id = $skill->id;
                    $profile_skill->save();
                }
            }
        }

        if($request->has('experience_id')){
            $experience_ids = $request->input('experience_id');
            $experiences = ProfileUserExperience::where('profile_user_id', $profile->id)->get();
            foreach ($experiences as $key => $experience) {
                if (!in_array($experience->id, $experience_ids)) {
                    $experience->delete();
                }
            }
        }
        if ($request->has('start_period')) {
            $start_periods = $request->input('start_period');
            $end_periods = $request->input('end_period');
            $comps = $request->input('company');
            $positions = $request->input('position');
            $descriptions = $request->input('description');
            $industry_ids = $request->input('industry_id');
            $salaries = $request->input('salary');
            
            for ($i=0;$i<count($start_periods);$i++) {
                if (trim($start_periods[$i]) != '' && trim($comps[$i]) != '' && trim($positions[$i]) != '') {
                    $jobExp = new ProfileUserExperience();
                    if($request->has('experience_id')){
                        if($i < count($experience_ids)){
                            if($experience_ids[$i] != null)
                                $jobExp = ProfileUserExperience::find($experience_ids[$i]);
                        }
                    }
                    $jobExp->profile_user_id = $profile->id;
                    $jobExp->start_period = $start_periods[$i];
                    $jobExp->end_period = $end_periods[$i];
                    $jobExp->company = $comps[$i];
                    $jobExp->position = $positions[$i];
                    $jobExp->description = $descriptions[$i];
                    $jobExp->industry_id = $industry_ids[$i];
                    $jobExp->salary = $salaries[$i];
                    $jobExp->save();
                }
            }
        }
        else{
            $old_exps = ProfileUserExperience::where('profile_user_id', $profile->id)->get();
            foreach ($old_exps as $key => $exp) {
                $exp->delete();
            }
        }

        //save all
        // DB::transaction(function () {
        //     DB::table('users')->update(['votes' => 1]);
         
        //     DB::table('posts')->delete();
        // });

        return Reply::redirect(route('profile.skills'), __('menu.applicantProfile') . ' ' . __('messages.createdSuccessfully'));
    }

    public function storeLanguages(StoreLanguage $request)
    {
        $profile_user_id = $request->profile_user_id;
        $profile = ProfileUser::find($profile_user_id);

        if($request->has('language_id')){
            $language_ids = $request->input('language_id');
            $languages = ProfileUserLanguage::where('profile_user_id', $profile->id)->get();
            foreach ($languages as $key => $language) {
                if (!in_array($language->id, $language_ids)) {
                    $language->delete();
                }
            }
        }
        if ($request->has('language_name')) {
            $language_names = $request->input('language_name');
            $language_levels = $request->input('language_level');
            
            for ($i=0;$i<count($language_names);$i++) {
                if (trim($language_names[$i]) != '' && trim($language_levels[$i]) != '') {
                    $lang = new ProfileUserLanguage();
                    if($request->has('language_id')){
                        if($i < count($language_ids)){
                            if($language_ids[$i] != null)
                                $lang = ProfileUserLanguage::find($language_ids[$i]);
                        }
                    }
                    $lang->profile_user_id = $profile->id;
                    $lang->name = $language_names[$i];
                    $lang->level = $language_levels[$i];
                    $lang->save();
                }
            }
        }

        return Reply::redirect(route('profile.languages'), __('menu.applicantProfile') . ' ' . __('messages.createdSuccessfully'));
    }

    public function storePortfolio(StorePortfolio $request)
    {
        $profile_user_id = $request->profile_user_id;
        $profile = ProfileUser::find($profile_user_id);

        if($request->has('portfolio_id')){
            $portfolio_ids = $request->input('portfolio_id');
            $portfolios = ProfileUserPortfolio::where('profile_user_id', $profile->id)->get();
            foreach ($portfolios as $key => $portfolio) {
                if (!in_array($portfolio->id, $portfolio_ids)) {
                    $portfolio->delete();
                }
            }
        }
        if ($request->has('portfolio')) {
            $portfolios = $request->input('portfolio');
            $urls = $request->input('url');
            
            for ($i=0;$i<count($portfolios);$i++) {
                if (trim($portfolios[$i]) != '' && trim($urls[$i]) != '') {
                    $port = new ProfileUserPortfolio();
                    if($request->has('portfolio_id')){
                        if($i < count($portfolio_ids)){
                            if($portfolio_ids[$i] != null)
                                $port = ProfileUserPortfolio::find($portfolio_ids[$i]);
                        }
                    }
                    $port->profile_user_id = $profile->id;
                    $port->name = $portfolios[$i];
                    $port->url = $urls[$i];
                    $port->save();
                }
            }
        }

        if ($request->hasFile('resume')) {
            // Files::deleteFile($profile->resumeDocument->hashname, 'documents/users'.$profile->id);
            $hashname = Files::upload($request->resume, 'documents/users/'.$profile->id, null, null, false);
            $profile->documents()->updateOrCreate([
                'documentable_type' => ProfileUser::class,
                'documentable_id' => $profile->id,
                'name' => 'Resume'
            ],
            [
                'hashname' => $hashname
            ]);
        }

        //save all
        // DB::transaction(function () {
        //     DB::table('users')->update(['votes' => 1]);
         
        //     DB::table('posts')->delete();
        // });

        return Reply::redirect(route('profile.portfolio'), __('menu.applicantProfile') . ' ' . __('messages.createdSuccessfully'));
    }

    public function showExperience()
    {
        return view('admin.job-applications.exp', ['_type' => request()->type, '_id' => request()->id]);
    }

    public function getExperience(Request $request)
    {
        $exps = $request->_type::find($request->_id)->experiences;

        return DataTables::of($exps)
            ->addIndexColumn()
            ->make(true);
    }

    public function fetchCountryState(Request $request)
    {
        $responseArr = [];

        $response = [
            "status" => "success", 
            "tp" => 1,
            "msg" => "Countries fetched successfully."
        ];

        switch ($request->type) {
            case 'getCountries':
                $countriesArray = json_decode(file_get_contents(public_path('country-state-city/countries.json')), true)['countries'];

                foreach ($countriesArray as $country) {
                    $responseArr = Arr::add($responseArr, $country['id'], $country['name']);
                }
            break;
            case 'getStates':
                $statesArray = json_decode(file_get_contents(public_path('country-state-city/states.json')), true)['states'];
                $countryId = $request->countryId;

                $filteredStates = array_filter($statesArray, function ($value) use ($countryId) {
                    return $value['country_id'] == $countryId;
                });

                foreach ($filteredStates as $state) {
                    $responseArr = Arr::add($responseArr, $state['id'], $state['name']);
                }
            break;
        }
        $response = Arr::add($response, "result", $responseArr);                

        return response()->json($response);
    }

    public function getName($arr, $id)
    {
        $result = array_filter($arr, function ($value) use ($id) {
            return $value['id'] == $id;
        });
        return current($result)['name'];
    }

    public function fetchLocations(Request $request)
    {
        $data = JobLocation::where('location', 'like', '%' . $request->q . '%')->select('id', 'location as text')->orderBy('location')->limit(5)->get();
        $res = array();
		foreach ($data as $d) {
			$res[] = $d->text;
		}
        return response()->json($res);
    }
}

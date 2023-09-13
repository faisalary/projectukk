<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;
use App\Permission;
use App\Module;

class AddApplyJobPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $module = new Module();
        $module->module_name = 'apply_job';
        $module->description = '';
        $module->save();

        $permissions = [
            ['name' => 'add_applied_job_applications', 'display_name' => 'Add Applied Job Applications', 'module_id' => $module->id],
            ['name' => 'view_applied_job_applications', 'display_name' => 'View Applied Job Applications', 'module_id' => $module->id],
            ['name' => 'edit_applied_job_applications', 'display_name' => 'Edit Applied Job Applications', 'module_id' => $module->id],
            ['name' => 'delete_applied_job_applications', 'display_name' => 'Delete Applied Job Applications', 'module_id' => $module->id],
        ];

        $applicant = new Role();
        $applicant->name = 'applicant';
        $applicant->display_name = 'Applicant'; // optional
        $applicant->description = 'Applicant is allowed to manage its applied job applications.'; // optional
        $applicant->save();

        $admin = Role::where('name', 'admin')->first();

        foreach ($permissions as $permission){

            $create = Permission::create($permission);
            $applicant->attachPermission($create);
            $admin->attachPermission($create);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $module = Module::where('module_name', 'apply_job')->first();
        Permission::where('module_id', $module->id)->delete();
    }
}

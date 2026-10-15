<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ClearDatabaseController extends Controller
{
    public function index()
    {
        return view('admin.clear-database.index');
    }

    public function clearDB()
    {
        // delete database and migrate fresh
        Artisan::call('migrate:fresh');
        // Seed the database

        Artisan::call('db:seed', ['--class' => 'UserSeeder']);
        Artisan::call('db:seed', ['--class' => 'SettingSeeder']);
        Artisan::call('db:seed', ['--class' => 'PaymentSettingSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolePermissionsSeeder']);

        return redirect()->route('admin.clear-database')
            ->with('success', 'Database cleared successfully.');

    }


}

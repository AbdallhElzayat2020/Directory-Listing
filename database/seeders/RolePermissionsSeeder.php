<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = array(
            array('id' => '1', 'name' => 'section index', 'group_name' => 'section', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:44:03', 'updated_at' => '2026-10-08 01:44:03'),
            array('id' => '2', 'name' => 'section create', 'group_name' => 'section', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:44:47', 'updated_at' => '2026-10-08 01:44:47'),
            array('id' => '3', 'name' => 'section update', 'group_name' => 'section', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:44:52', 'updated_at' => '2026-10-08 01:44:52'),
            array('id' => '4', 'name' => 'section delete', 'group_name' => 'section', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:45:03', 'updated_at' => '2026-10-08 01:45:03'),
            array('id' => '5', 'name' => 'listing index', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:45:28', 'updated_at' => '2026-10-08 01:45:28'),
            array('id' => '6', 'name' => 'listing create', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:45:47', 'updated_at' => '2026-10-08 01:45:47'),
            array('id' => '7', 'name' => 'listing update', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:45:53', 'updated_at' => '2026-10-08 01:45:53'),
            array('id' => '8', 'name' => 'listing delete', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:45:57', 'updated_at' => '2026-10-08 01:45:57'),
            array('id' => '9', 'name' => 'pending listing', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:46:12', 'updated_at' => '2026-10-08 01:46:12'),
            array('id' => '10', 'name' => 'package index', 'group_name' => 'package', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:46:46', 'updated_at' => '2026-10-08 01:46:46'),
            array('id' => '11', 'name' => 'package create', 'group_name' => 'package', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:46:52', 'updated_at' => '2026-10-08 01:46:52'),
            array('id' => '12', 'name' => 'package update', 'group_name' => 'package', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:46:57', 'updated_at' => '2026-10-08 01:46:57'),
            array('id' => '13', 'name' => 'package delete', 'group_name' => 'package', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:47:02', 'updated_at' => '2026-10-08 01:47:02'),
            array('id' => '14', 'name' => 'order index', 'group_name' => 'order', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:47:11', 'updated_at' => '2026-10-08 01:47:11'),
            array('id' => '15', 'name' => 'order delete', 'group_name' => 'order', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:47:17', 'updated_at' => '2026-10-08 01:47:17'),
            array('id' => '16', 'name' => 'message index', 'group_name' => 'message', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:47:32', 'updated_at' => '2026-10-08 01:47:32'),
            array('id' => '17', 'name' => 'message show', 'group_name' => 'message', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:47:43', 'updated_at' => '2026-10-08 01:47:43'),
            array('id' => '18', 'name' => 'message delete', 'group_name' => 'message', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:47:49', 'updated_at' => '2026-10-08 01:47:49'),
            array('id' => '19', 'name' => 'blog index', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:48:03', 'updated_at' => '2026-10-08 01:48:03'),
            array('id' => '20', 'name' => 'blog create', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:48:07', 'updated_at' => '2026-10-08 01:48:07'),
            array('id' => '21', 'name' => 'blog update', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:48:14', 'updated_at' => '2026-10-08 01:48:14'),
            array('id' => '22', 'name' => 'blog delete', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:48:18', 'updated_at' => '2026-10-08 01:48:18'),
            array('id' => '23', 'name' => 'setting index', 'group_name' => 'setting', 'guard_name' => 'web', 'created_at' => '2026-10-08 01:48:59', 'updated_at' => '2026-10-08 01:48:59')
        );

        $roles = array(
            array('id' => '2', 'name' => 'Editor', 'guard_name' => 'web', 'created_at' => '2026-10-08 02:17:51', 'updated_at' => '2026-10-08 02:17:51'),
            array('id' => '3', 'name' => 'Manager', 'guard_name' => 'web', 'created_at' => '2026-10-08 05:26:12', 'updated_at' => '2026-10-08 05:26:12'),
            array('id' => '4', 'name' => 'Super Admin', 'guard_name' => 'web', 'created_at' => '2026-10-08 06:05:10', 'updated_at' => '2026-10-08 06:05:10')
        );

        $role_has_permissions = array(
            array('permission_id' => '1', 'role_id' => '2'),
            array('permission_id' => '2', 'role_id' => '2'),
            array('permission_id' => '3', 'role_id' => '2'),
            array('permission_id' => '4', 'role_id' => '2'),
            array('permission_id' => '5', 'role_id' => '3'),
            array('permission_id' => '6', 'role_id' => '3'),
            array('permission_id' => '7', 'role_id' => '3'),
            array('permission_id' => '8', 'role_id' => '3'),
            array('permission_id' => '9', 'role_id' => '3')
        );

        $model_has_roles = array(
            array('role_id' => '4', 'model_type' => 'App\\Models\\User', 'model_id' => '1'),
            array('role_id' => '3', 'model_type' => 'App\\Models\\User', 'model_id' => '2'),
            array('role_id' => '2', 'model_type' => 'App\\Models\\User', 'model_id' => '6'),
            array('role_id' => '3', 'model_type' => 'App\\Models\\User', 'model_id' => '7')
        );

        DB::table('permissions')->insert($permissions);
        DB::table('roles')->insert($roles);
        DB::table('role_has_permissions')->insert($role_has_permissions);
        DB::table('model_has_roles')->insert($model_has_roles);

    }
}

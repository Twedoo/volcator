<?php

/**
 * This file is part of StoneGuard,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Twedoo\Stone
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Stone Space Model
    |--------------------------------------------------------------------------
    |
    | This is the Module model used by Stone to create correct relations. Update
    | the module if it is in a different namespace.
    |
    */
    'spaces' => 'Twedoo\Stone\Application\Models\Spaces',

    /*
    |--------------------------------------------------------------------------
    | Stone Spaces Table
    |--------------------------------------------------------------------------
    |
    | This is the modules table used by Stone to save roles to the database.
    |
    */
    'spaces_table' => 'spaces',


    /*
    |--------------------------------------------------------------------------
    | Stone Application Model
    |--------------------------------------------------------------------------
    |
    | This is the Module model used by Stone to create correct relations. Update
    | the module if it is in a different namespace.
    |
    */
    'applications' => 'Twedoo\Stone\Application\Models\Applications',

    /*
    |--------------------------------------------------------------------------
    | Stone Applications Table
    |--------------------------------------------------------------------------
    |
    | This is the modules table used by Stone to save roles to the database.
    |
    */
    'applications_table' => 'applications',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard applications_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by StoneGuard to save assigned roles to the
    | database.
    |
    */
    'applications_user_table' => 'applications_user',


    /*
    |--------------------------------------------------------------------------
    | StoneGuard applications_module Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by StoneGuard to save assigned roles to the
    | database.
    |
    */
    'applications_module_table' => 'applications_module',

    /*
    |--------------------------------------------------------------------------
    | Stone Module Model
    |--------------------------------------------------------------------------
    |
    | This is the Module model used by Stone to create correct relations. Update
    | the module if it is in a different namespace.
    |
    */
    'module' => 'Twedoo\Stone\Organizer\Models\modules',

    /*
    |--------------------------------------------------------------------------
    | Stone Modules Table
    |--------------------------------------------------------------------------
    |
    | This is the modules table used by Stone to save roles to the database.
    |
    */
    'modules_table' => 'modules',

    /*
    |--------------------------------------------------------------------------
    | Stone Parameter Model
    |--------------------------------------------------------------------------
    |
    | This is the Parameter model used by Stone to create correct relations. Update
    | the parameter if it is in a different namespace.
    |
    */
    'parameters' => 'Twedoo\Stone\Models\Parameters',

    /*
    |--------------------------------------------------------------------------
    | Stone Parameters Table
    |--------------------------------------------------------------------------
    |
    | This is the parameters table used by Stone to save roles to the database.
    |
    */
    'parameters_table' => 'parameters',

    /*
    |--------------------------------------------------------------------------
    | Stone Menuback Model
    |--------------------------------------------------------------------------
    |
    | This is the Menuback model used by Stone to create correct relations. Update
    | the menuback if it is in a different namespace.
    |
    */
    'menuback' => 'Twedoo\Stone\Models\Menuback',

    /*
    |--------------------------------------------------------------------------
    | Stone Menubacks Table
    |--------------------------------------------------------------------------
    |
    | This is the menubacks table used by Stone to save roles to the database.
    |
    */
    'menubacks_table' => 'menubacks',

    /*
    |--------------------------------------------------------------------------
    | Stone Language Model
    |--------------------------------------------------------------------------
    |
    | This is the Language model used by Stone to create correct relations. Update
    | the Language if it is in a different namespace.
    |
    */
    'Language' => 'Twedoo\Stone\Models\Languages',

    /*
    |--------------------------------------------------------------------------
    | Stone Language Table
    |--------------------------------------------------------------------------
    |
    | This is the languages table used by Stone to save roles to the database.
    |
    */
    'languages_table' => 'languages',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard Role Model
    |--------------------------------------------------------------------------
    |
    | This is the Role model used by StoneGuard to create correct relations.  Update
    | the role if it is in a different namespace.
    |
    */
    'role' => 'Twedoo\StoneGuard\Models\Role',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard Roles Table
    |--------------------------------------------------------------------------
    |
    | This is the roles table used by StoneGuard to save roles to the database.
    |
    */
    'roles_table' => 'roles',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard role foreign key
    |--------------------------------------------------------------------------
    |
    | This is the role foreign key used by StoneGuard to make a proper
    | relation between permissions and roles & roles and users
    |
    */
    'role_foreign_key' => 'role_id',

    /*
    |--------------------------------------------------------------------------
    | Application User Model
    |--------------------------------------------------------------------------
    |
    | This is the User model used by StoneGuard to create correct relations.
    | Update the User if it is in a different namespace.
    |
    */
    'user' => 'App\Models\User',

    /*
    |--------------------------------------------------------------------------
    | Application Users Table
    |--------------------------------------------------------------------------
    |
    | This is the users table used by the application to save users to the
    | database.
    |
    */
    'users_table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard role_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by StoneGuard to save assigned roles to the
    | database.
    |
    */
    'role_user_table' => 'role_user',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard user foreign key
    |--------------------------------------------------------------------------
    |
    | This is the user foreign key used by StoneGuard to make a proper
    | relation between roles and users
    |
    */
    'user_foreign_key' => 'user_id',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard Permission Model
    |--------------------------------------------------------------------------
    |
    | This is the Permission model used by StoneGuard to create correct relations.
    | Update the permission if it is in a different namespace.
    |
    */
    'permission' => 'Twedoo\StoneGuard\Models\Permission',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard Permissions Table
    |--------------------------------------------------------------------------
    |
    | This is the permissions table used by StoneGuard to save permissions to the
    | database.
    |
    */
    'permissions_table' => 'permissions',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard permission_role Table
    |--------------------------------------------------------------------------
    |
    | This is the permission_role table used by StoneGuard to save relationship
    | between permissions and roles to the database.
    |
    */
    'permission_role_table' => 'permission_role',

    /*
    |--------------------------------------------------------------------------
    | StoneGuard role_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by StoneGuard to save assigned roles to the
    | database.
    |
    */
    'role_user_table' => 'role_user',

    /*
    |--------------------------------------------------------------------------
    | User Foreign key on StoneGuard's role_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    'user_foreign_key' => 'user_id',

    /*
    |--------------------------------------------------------------------------
    | Role Foreign key on StoneGuard's role_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    'role_foreign_key' => 'role_id',

    /*
    |--------------------------------------------------------------------------
    | Location module uploaded
    |--------------------------------------------------------------------------
    */
    'module_upload' => [
        'driver' => 'local',
        'root' => base_path('/app/Modules/'),
        'url' => env('APP_URL').'/app/Modules',
    ],
];

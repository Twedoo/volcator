<?php

/**
 * This file is part of VolcatorGuard,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Twedoo\Volcator
 */

return [

    'APP_NAME' => 'Volcator Space',
    /*
    |--------------------------------------------------------------------------
    | Volcator Space Model
    |--------------------------------------------------------------------------
    |
    | This is the Module model used by Volcator to create correct relations. Update
    | the module if it is in a different namespace.
    |
    */
    'spaces' => 'Twedoo\Volcator\Application\Models\Spaces',

    /*
    |--------------------------------------------------------------------------
    | Volcator Spaces Table
    |--------------------------------------------------------------------------
    |
    | This is the modules table used by Volcator to save roles to the database.
    |
    */
    'spaces_table' => 'spaces',


    /*
    |--------------------------------------------------------------------------
    | Volcator Application Model
    |--------------------------------------------------------------------------
    |
    | This is the Module model used by Volcator to create correct relations. Update
    | the module if it is in a different namespace.
    |
    */
    'applications' => 'Twedoo\Volcator\Application\Models\Applications',

    /*
    |--------------------------------------------------------------------------
    | Volcator Applications Table
    |--------------------------------------------------------------------------
    |
    | This is the modules table used by Volcator to save roles to the database.
    |
    */
    'applications_table' => 'applications',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard applications_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by VolcatorGuard to save assigned roles to the
    | database.
    |
    */
    'applications_user_table' => 'applications_user',


    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard applications_volcator Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by VolcatorGuard to save assigned roles to the
    | database.
    |
    */
    'applications_volcator_table' => 'applications_volcator',

    /*
    |--------------------------------------------------------------------------
    | Volcator Module Model
    |--------------------------------------------------------------------------
    |
    | This is the Module model used by Volcator to create correct relations. Update
    | the module if it is in a different namespace.
    |
    */
    'module' => 'Twedoo\Volcator\Organizer\Models\Volcators',

    /*
    |--------------------------------------------------------------------------
    | Volcator Modules Table
    |--------------------------------------------------------------------------
    |
    | This is the modules table used by Volcator to save roles to the database.
    |
    */
    'volcators_table' => 'volcators',

    /*
    |--------------------------------------------------------------------------
    | Volcator Parameter Model
    |--------------------------------------------------------------------------
    |
    | This is the Parameter model used by Volcator to create correct relations. Update
    | the parameter if it is in a different namespace.
    |
    */
    'parameters' => 'Twedoo\Volcator\Models\Parameters',

    /*
    |--------------------------------------------------------------------------
    | Volcator Parameters Table
    |--------------------------------------------------------------------------
    |
    | This is the parameters table used by Volcator to save roles to the database.
    |
    */
    'parameters_table' => 'parameters',

    /*
    |--------------------------------------------------------------------------
    | Volcator Menuback Model
    |--------------------------------------------------------------------------
    |
    | This is the Menuback model used by Volcator to create correct relations. Update
    | the menuback if it is in a different namespace.
    |
    */
    'menuback' => 'Twedoo\Volcator\Models\Menuback',

    /*
    |--------------------------------------------------------------------------
    | Volcator Menubacks Table
    |--------------------------------------------------------------------------
    |
    | This is the menubacks table used by Volcator to save roles to the database.
    |
    */
    'menuBacks_table' => 'menubacks',

    /*
    |--------------------------------------------------------------------------
    | Volcator Language Model
    |--------------------------------------------------------------------------
    |
    | This is the Language model used by Volcator to create correct relations. Update
    | the Language if it is in a different namespace.
    |
    */
    'Language' => 'Twedoo\Volcator\Models\Languages',

    /*
    |--------------------------------------------------------------------------
    | Volcator Language Table
    |--------------------------------------------------------------------------
    |
    | This is the languages table used by Volcator to save roles to the database.
    |
    */
    'languages_table' => 'languages',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard Role Model
    |--------------------------------------------------------------------------
    |
    | This is the Role model used by VolcatorGuard to create correct relations.  Update
    | the role if it is in a different namespace.
    |
    */
    'role' => 'Twedoo\VolcatorGuard\Models\Role',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard Roles Table
    |--------------------------------------------------------------------------
    |
    | This is the roles table used by VolcatorGuard to save roles to the database.
    |
    */
    'roles_table' => 'roles',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard role foreign key
    |--------------------------------------------------------------------------
    |
    | This is the role foreign key used by VolcatorGuard to make a proper
    | relation between permissions and roles & roles and users
    |
    */
    'role_foreign_key' => 'role_id',

    /*
    |--------------------------------------------------------------------------
    | Application User Model
    |--------------------------------------------------------------------------
    |
    | This is the User model used by VolcatorGuard to create correct relations.
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
    | VolcatorGuard role_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by VolcatorGuard to save assigned roles to the
    | database.
    |
    */
    'role_user_table' => 'role_user',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard user foreign key
    |--------------------------------------------------------------------------
    |
    | This is the user foreign key used by VolcatorGuard to make a proper
    | relation between roles and users
    |
    */
    'user_foreign_key' => 'user_id',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard Permission Model
    |--------------------------------------------------------------------------
    |
    | This is the Permission model used by VolcatorGuard to create correct relations.
    | Update the permission if it is in a different namespace.
    |
    */
    'permission' => 'Twedoo\VolcatorGuard\Models\Permission',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard Permissions Table
    |--------------------------------------------------------------------------
    |
    | This is the permissions table used by VolcatorGuard to save permissions to the
    | database.
    |
    */
    'permissions_table' => 'permissions',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard permission_role Table
    |--------------------------------------------------------------------------
    |
    | This is the permission_role table used by VolcatorGuard to save relationship
    | between permissions and roles to the database.
    |
    */
    'permission_role_table' => 'permission_role',

    /*
    |--------------------------------------------------------------------------
    | VolcatorGuard role_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by VolcatorGuard to save assigned roles to the
    | database.
    |
    */
    'role_user_table' => 'role_user',

    /*
    |--------------------------------------------------------------------------
    | User Foreign key on VolcatorGuard's role_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    'user_foreign_key' => 'user_id',

    /*
    |--------------------------------------------------------------------------
    | Role Foreign key on VolcatorGuard's role_user Table (Pivot)
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

    /*
    |--------------------------------------------------------------------------
    | Alias Permissions name constants
    |--------------------------------------------------------------------------
    */
    // Permissions and Roles MAJESTIC
    'MAJESTIC' => "MAJESTIC",
    "PERMISSION_MAJESTIC_VOLCATOR"          => 'Permission-Majestic-Volcator',
    // Permissions Organizer
    "PERMISSION_MANAGER_ORGANIZER_FULL"     => "Permission-Manager-Organizer-Full",
    // Permissions Access Controls
    "PERMISSION_USER_ACCESS_CONTROL"        => 'Permission-User-Access-Control',
    "PERMISSION_ROLE_ACCESS_CONTROL"        => 'Permission-Role-Access-Control',
    "PERMISSION_PERMISSION_ACCESS_CONTROL"  => 'Permission-Permission-Access-Control',
    // Permissions Space
    "PERMISSION_SPACE_FULL"                 => 'Permission-Space-Full',
    "PERMISSION_SPACE_VIEW"                 => 'Permission-Space-View',
    // Permissions Application
    "PERMISSION_APPLICATION_FULL"           => 'Permission-Application-Full',
    "PERMISSION_APPLICATION_VIEW"           => 'Permission-Application-View',
    // Permissions Volcator Vue
    "PERMISSION_VOLCATOR_VYE"              => 'Permission-volcator-vye',

    /*
    |--------------------------------------------------------------------------
    | Alias Roles name constants
    |--------------------------------------------------------------------------
    */
    // Roles Space
    "ROLE_MANAGER_SPACE"                    => 'Role-Manager-Space',
    "ROLE_USER_SPACE"                       => 'Role-User-Space',
    // Roles Organizer
    "ROLE_MANAGER_ORGANIZER_FULL"           => 'Role-Manager-Organizer-Full',
    // Roles Access Controls
    "ROLE_ACCESS_CONTROL_FULL"              => 'Role-Access-Control-Full',
    // Roles Application
    "ROLE_APPLICATION_FULL"                 => 'Role-Application-Full',
    "ROLE_APPLICATION_VIEW"                 => 'Role-Application-View',
    // Roles Configuration
    "ROLE_CONFIGURATION_FULL"               => 'Role-Access-Configuration',

    // Roles Volcator Vue
    "ROLE_Volcator_HEADPIECE"               => 'Role-Volcator-Headpiece',

    /*
    |--------------------------------------------------------------------------
    | Alias Roles name constants
    |--------------------------------------------------------------------------
    */
    'markdown' => [
        'theme' => 'default',
        'paths' => [
            'elements/email/mail',
        ]
    ],
];

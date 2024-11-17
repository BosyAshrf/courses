<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User model class
    |--------------------------------------------------------------------------
     */

    'user_model' => 'App\Models\Admin',

    /*
    |--------------------------------------------------------------------------
    | Nova User resource tool class
    |--------------------------------------------------------------------------
     */

    'user_resource' => 'App\Nova\Admin',

    /*
    |--------------------------------------------------------------------------
    | The group associated with the resource
    |--------------------------------------------------------------------------
     */

    'role_resource_group' => 'Other',

    /*
    |--------------------------------------------------------------------------
    | Database table names
    |--------------------------------------------------------------------------
    | When using the "HasRoles" trait from this package, we need to know which
    | table should be used to retrieve your roles. We have chosen a basic
    | default value but you may easily change it to any table you like.
     */

    'table_names' => [
        'roles' => 'roles',

        'role_permission' => 'role_permission',

        'role_user' => 'role_admin',

        'users' => 'admins',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Permissions
    |--------------------------------------------------------------------------
     */

    'permissions' => [
        'view admins' => [
            'display_name' => 'view admins',
            'description' => 'Can view admins',
            'group' => 'Admins',
        ],
        'create admins' => [
            'display_name' => 'create admins',
            'description' => 'Can create admins',
            'group' => 'Admins',
        ],

        'update admins' => [
            'display_name' => 'Update admins',
            'description' => 'Can update admins',
            'group' => 'Admins',
        ],

        'delete admins' => [
            'display_name' => 'delete admins',
            'description' => 'Can delete admins',
            'group' => 'Admins',
        ],
        'view users' => [
            'display_name' => 'View users',
            'description' => 'Can view users',
            'group' => 'User',
        ],

        'create users' => [
            'display_name' => 'Create users',
            'description' => 'Can create users',
            'group' => 'User',
        ],

        'edit users' => [
            'display_name' => 'Edit users',
            'description' => 'Can edit users',
            'group' => 'User',
        ],

        'delete users' => [
            'display_name' => 'Delete users',
            'description' => 'Can delete users',
            'group' => 'User',
        ],

        'view roles' => [
            'display_name' => 'View roles',
            'description' => 'Can view roles',
            'group' => 'Role',
        ],

        'create roles' => [
            'display_name' => 'Create roles',
            'description' => 'Can create roles',
            'group' => 'Role',
        ],

        'update roles' => [
            'display_name' => 'Update roles',
            'description' => 'Can update roles',
            'group' => 'Role',
        ],

        'delete roles' => [
            'display_name' => 'Delete roles',
            'description' => 'Can delete roles',
            'group' => 'Role',
        ],

        'view categories' => [
            'display_name' => 'View categories',
            'description' => 'Can view categories',
            'group' => 'Category',
        ],

        'create categories' => [
            'display_name' => 'Create categories',
            'description' => 'Can create categories',
            'group' => 'Category',
        ],

        'update categories' => [
            'display_name' => 'Update categories',
            'description' => 'Can update categories',
            'group' => 'Category',
        ],

        'delete categories' => [
            'display_name' => 'Delete categories',
            'description' => 'Can delete categories',
            'group' => 'Category',
        ],
        'view courses' => [
            'display_name' => 'View courses',
            'description' => 'Can view courses',
            'group' => 'Course',
        ],

        'create courses' => [
            'display_name' => 'Create courses',
            'description' => 'Can create courses',
            'group' => 'Course',
        ],

        'update courses' => [
            'display_name' => 'Update courses',
            'description' => 'Can update courses',
            'group' => 'Course',
        ],

        'delete courses' => [
            'display_name' => 'Delete courses',
            'description' => 'Can delete courses',
            'group' => 'Course',
        ],
        'view experts' => [
            'display_name' => 'view experts',
            'description' => 'Can view experts',
            'group' => 'Experts',
        ],
        'create experts' => [
            'display_name' => 'create experts',
            'description' => 'Can create experts',
            'group' => 'Experts',
        ],

        'edit experts' => [
            'display_name' => 'edit experts',
            'description' => 'Can edit experts',
            'group' => 'Experts',
        ],

        'delete experts' => [
            'display_name' => 'delete experts',
            'description' => 'Can delete experts',
            'group' => 'Experts',
        ],
        'view_general_settings' => [
            'display_name' => 'View General Settings',
            'description' => 'Can view general settings',
            'group' => 'Settings',
        ],

    ],
];

<?php

return [
    'controllers' => [
        'assign_role' => 'BugLock\rolePermissionModule\Http\Controllers\Assign\RoleController.php'
    ],

    // Middleware Success and Error Messages
    'middleware' => [
        'sucess' => [],
        'error' => [
            'unauthorized' => 'Please log in to access this page.',
            'unauthorized-active' => 'Your account is deatived !',
            'unauthorized-role' => 'Your account does not have the necessary role to access this page.',
            'unauthorized-permission'=>"You don't have the required permission to access this page or perform this action.",
            'server-error'=>'Oops! Something went wrong on our end. Please try again in a little while.'
        ]
    ],

    //User authenticable primary key/column
    'primary_key' => 'id',

    // User authenticable primary key/column
    'guard' => 'web',

    //If user have multiple roles
    'one-to-many-man' => true
];

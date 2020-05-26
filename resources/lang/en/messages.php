<?php

return [
    'custom_error' => [
        'bad_request' => [
            'code' => '1001',
            'description' => 'Bad request.',
        ],
        'unauthorized' => [
            'code' => '1002',
            'description' => 'Unauthorized, please check your credentials.',
        ],
        'not_found_http' => [
            'code' => '1003',
            'description' => 'Not found.',
        ],
        'method_not_allow' => [
            'code' => '1004',
            'description' => 'Method not allow.',
        ],
        'model_not_found' => [
            'code' => '1005',
            'description' => 'Model not found.',
        ],
        'login_failed' => [
            'code' => '1006',
            'description' => 'Login failed.',
        ],
        'fail_validation' => [
            'code' => '1022',
            'description' => 'Failed validation.',
        ],
        'please_choose_a_shop' => [
            'code' => '1008',
            'description' => 'Please choose a shop.',
        ],
        'invalid_permission' => [
            'code' => '1009',
            'description' => 'You need permission to perform this action',
        ],
        'send_email_failed' => [
            'code' => '1010',
            'description' => 'Send email failed.',
        ],
        'assign_admin_permission' => [
            'code' => '1011',
            'description' => 'The designation of a person in charge in this shop is not required.',
        ],
        'register_error' => [
            'code' => '1012',
            'description' => 'Registration failed.',
        ],
        'update_error' => [
            'code' => '1013',
            'description' => 'Update failed.',
        ],
        'delete_error' => [
            'code' => '1014',
            'description' => 'Delete failed.',
        ],
        'error' => [
            'code' => '1007',
            'description' => 'Failed.',
        ],
    ],
    'register_success' => 'Succeeded.',
    'update_success' => 'Update was successful.',
    'elasticsearch' => [
        'drop_index_fail' => 'Drop index fail.',
    ],
    'postal_code_not_found' => 'Postal code not found.'
];

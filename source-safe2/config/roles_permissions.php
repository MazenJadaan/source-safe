<?php
return [
    'roles_and_permissions' => [
        'Admin' => [
            'manage_all_groups',
            'manage_all_files',
            'view_all_reports',
            'perform_system_backups',
            'restore_system_backups',
            'send_system_notifications',
        ],
        'GroupAdmin' => [
            'create_group',
            'update_group',
            'delete_group',
            'view_group_details',
            'manage_group_files',
            'view_group_reports',
            'upload_file',
            'create_group',
            'download_file',
            'view_own_files',
            'request_file_approval',
        ],
        'User' => [
            'upload_file',
            'create_group',
            'download_file',
            'view_own_files',
            'request_file_approval',
        ],
    ],
];

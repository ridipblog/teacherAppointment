<?php

return [
    'posts' => [
        '1' => 'Graduate Teacher',
        '2' => 'Post Graduate Teacher'
    ],
    'forms' => [
        'add',
        'update',
        'view',
        'delete'
    ],
    'accessRoutes'=>[
        '1'=>'/operator',
        '2'=>'/admin'
    ],
    'reports' => [
        'assignCandCountWithUser' => [
            'title' => 'User-wise Assigned',
            'removedColumns' => [
                'userID'
            ]
        ],
        'AssignedCandDetailsWithUser' => [
            'title' => 'Assigned Candidates with User',
            'removedColumns' => [
                'userId',
                'id',
                'post',
                'allocatedSchoolCode',
                'isAllocated',
                'created_at',
                'updated_at',
                'generatedBy',
                'letterCode',
                'active'
            ]
        ],
        'ReportRemainingVacancyPg' => [
            'title' => 'PG Remaining Vacancies',
            'removedColumns' => []
        ],
        'ReportRemainingVacancyUg' => [
            'title' => 'UG Remaining Vacancies',
            'removedColumns' => []
        ],
        'ReportSelectedCandidatePg' => [
            'title' => 'PG Assigned Candidates',
            'removedColumns' => []
        ],
        'ReportSelectedCandidateUg' => [
            'title' => 'UG Assigned Candidates',
            'removedColumns' => []
        ],
    ],
    'userStatus'=>[
        '1'=>'active',
        '2'=>'deactive'
    ]
];

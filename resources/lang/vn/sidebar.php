<?php
return [
    'module' => [
        [
            'title' => 'Dashboard',
            'icon' => 'fa fa-th-large',
            'name' => ['dashboard'],
            'route' => 'dashboard/index',
            'class' => 'special'
        ],
        [
            'title' => 'Dịch Vụ',
            'icon' => 'fa fa-briefcase',
            'name' => ['service'],
            'subModule' => [
                [
                    'title' => 'Danh sách dịch vụ',
                    'route' => 'service/index'
                ],
                [
                    'title' => 'Nhóm dịch vụ',
                    'route' => 'service/catalogue/index'
                ],
            ]
        ],
        [
            'title' => 'Dự án',
            'icon' => 'fa fa-building',
            'name' => ['project'],
            'subModule' => [
                [
                    'title' => 'Danh sách dự án',
                    'route' => 'project/index'
                ],
                [
                    'title' => 'Nhóm dự án',
                    'route' => 'project/catalogue/index'
                ],
            ]
        ],
        [
            'title' => 'Thư viện ảnh',
            'icon' => 'fa fa-picture-o',
            'name' => ['gallery', 'gallery_catalogue'],
            'subModule' => [
                [
                    'title' => 'Danh sách',
                    'route' => 'gallery/index'
                ],
                [
                    'title' => 'Nhóm thư viện',
                    'route' => 'gallery/catalogue/index'
                ]
            ]
        ],
        [
            'title' => 'Đội ngũ',
            'icon' => 'fa fa-users',
            'name' => ['team'],
            'subModule' => [
                [
                    'title' => 'Nhân sự',
                    'route' => 'team/index'
                ],
            ]
        ],
        [
            'title' => 'Hỏi đáp (FAQ)',
            'icon' => 'fa fa-question-circle',
            'name' => ['faq'],
            'subModule' => [
                [
                    'title' => 'Câu hỏi',
                    'route' => 'faq/index'
                ],
                [
                    'title' => 'Nhóm câu hỏi',
                    'route' => 'faq/catalogue/index'
                ],
            ]
        ],
        [
            'title' => 'Đối tác',
            'icon' => 'fa fa-handshake-o',
            'name' => ['partner'],
            'subModule' => [
                [
                    'title' => 'Danh sách',
                    'route' => 'partner/index'
                ],
            ]
        ],
        [
            'title' => 'Thành tựu',
            'icon' => 'fa fa-trophy',
            'name' => ['achievement'],
            'subModule' => [
                [
                    'title' => 'Danh sách',
                    'route' => 'achievement/index'
                ],
            ]
        ],
        [
            'title' => 'Giá trị cốt lõi',
            'icon' => 'fa fa-diamond',
            'name' => ['core-value'],
            'subModule' => [
                [
                    'title' => 'Danh sách',
                    'route' => 'core-value/index'
                ],
            ]
        ],
        [
            'title' => 'Quy trình làm việc',
            'icon' => 'fa fa-retweet',
            'name' => ['work-process'],
            'subModule' => [
                [
                    'title' => 'Danh sách',
                    'route' => 'work-process/index'
                ],
            ]
        ],
        [
            'title' => 'Bài viết',
            'icon' => 'fa fa-file',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'Bài viết',
                    'route' => 'post/index'
                ],
                [
                    'title' => 'Nhóm bài viết',
                    'route' => 'post/catalogue/index'
                ],
            ]
        ],
        [
            'title' => 'Đánh giá',
            'icon' => 'fa fa-star',
            'name' => ['review'],
            'subModule' => [
                [
                    'title' => 'Danh sách đánh giá',
                    'route' => 'review/index'
                ],
            ]
        ],
        [
            'title' => 'QL Liên Hệ',
            'icon' => 'fa fa-phone-square',
            'name' => ['contacts'],
            'subModule' => [
                [
                    'title' => 'QL Liên Hệ',
                    'route' => 'visit_request/index'
                ]
            ]
        ],
        [
            'title' => 'QL Menu',
            'icon' => 'fa fa-bars',
            'name' => ['menu'],
            'subModule' => [
                [
                    'title' => 'Cài đặt Menu',
                    'route' => 'menu/index'
                ],
            ]
        ],
        [
            'title' => 'Cấu hình chung',
            'icon' => 'fa fa-cog',
            'name' => ['language', 'generate', 'system', 'widget'],
            'subModule' => [
                [
                    'title' => 'Cấu hình hệ thống',
                    'route' => 'system/index'
                ],

            ]
        ]
    ],
];

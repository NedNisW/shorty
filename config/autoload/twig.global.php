<?php
declare(strict_types=1);

return [
    'twig' => [
        'globals' => [
            'project_title' => (string) ($_ENV['PROJECT_TITLE'] ?? 'Shorty'),
        ],
    ],
    'templates' => [
        'paths' => [
            realpath(__DIR__ . '/../../templates')
        ]
    ]
];
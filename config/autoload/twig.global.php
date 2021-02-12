<?php
declare(strict_types=1);

return [
    'twig' => [
        'globals' => [
            'project_title' => 'Shortlink Creator',
        ],
    ],
    'templates' => [
        'paths' => [
            'shorty' => realpath(__DIR__ . '/../../templates')
        ]
    ]
];
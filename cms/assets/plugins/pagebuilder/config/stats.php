<?php

return [
    'title'     => 'Счётчики',
    'container' => 'default',
    'order'     => 18,
    'fields'    => [
        'items' => ['caption' => 'Показатели', 'type' => 'group', 'fields' => [
            'value'  => ['caption' => 'Число/значение', 'type' => 'text', 'layout' => 'col-4'],
            'suffix' => ['caption' => 'Суффикс', 'type' => 'text', 'layout' => 'col-3'],
            'label'  => ['caption' => 'Подпись', 'type' => 'text', 'layout' => 'col-5'],
        ]],
    ],
];

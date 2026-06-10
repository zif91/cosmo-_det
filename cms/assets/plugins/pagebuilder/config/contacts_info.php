<?php

return [
    'title'     => 'Контакты + карта',
    'container' => 'default',
    'order'     => 22,
    'fields'    => [
        'checks'    => ['caption' => 'Как добраться (чек-лист)', 'type' => 'group', 'fields' => [
            'text' => ['caption' => 'Пункт', 'type' => 'text'],
        ]],
        'map_embed' => ['caption' => 'URL виджета карты (пусто = из настроек)', 'type' => 'text'],
    ],
];

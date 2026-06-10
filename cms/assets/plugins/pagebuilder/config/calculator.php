<?php

return [
    'title'     => 'Калькулятор сметы',
    'container' => 'default',
    'order'     => 15,
    'fields'    => [
        'eyebrow'     => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4'],
        'heading'     => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'text'        => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'mode1_label' => ['caption' => 'Режим 1 — название', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Детейлинг и защита'],
        'mode2_label' => ['caption' => 'Режим 2 — название', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Ремонт сколов · ГОСТ'],
        'note'        => ['caption' => 'Примечание к смете', 'type' => 'text', 'layout' => 'col-4'],
    ],
];

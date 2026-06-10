<?php

return [
    'title'     => 'Радар зон защиты',
    'container' => 'default',
    'order'     => 14,
    'fields'    => [
        'eyebrow'     => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4'],
        'heading'     => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'text'        => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'panel_tag'   => ['caption' => 'Метка панели', 'type' => 'text', 'layout' => 'col-4'],
        'meta1_value' => ['caption' => 'Показатель 1', 'type' => 'text', 'layout' => 'col-2'],
        'meta1_label' => ['caption' => 'Подпись 1', 'type' => 'text', 'layout' => 'col-2'],
        'meta2_value' => ['caption' => 'Показатель 2', 'type' => 'text', 'layout' => 'col-2'],
        'meta2_label' => ['caption' => 'Подпись 2', 'type' => 'text', 'layout' => 'col-2'],
        'image'       => ['caption' => 'Фото авто', 'type' => 'image'],
        'hotspots'    => ['caption' => 'Точки на фото', 'type' => 'group', 'fields' => [
            'zone'  => ['caption' => 'Зона (hood/windshield/interior/sides/wheels)', 'type' => 'text', 'layout' => 'col-4'],
            'left'  => ['caption' => 'Слева, %', 'type' => 'text', 'layout' => 'col-2'],
            'top'   => ['caption' => 'Сверху, %', 'type' => 'text', 'layout' => 'col-2'],
            'label' => ['caption' => 'Подпись', 'type' => 'text', 'layout' => 'col-4'],
        ]],
    ],
];

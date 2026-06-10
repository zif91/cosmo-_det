<?php

return [
    'title'     => 'Пакеты услуг',
    'container' => 'default',
    'order'     => 16,
    'fields'    => [
        'eyebrow' => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4'],
        'heading' => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'text'    => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'items'   => ['caption' => 'Пакеты', 'type' => 'group', 'fields' => [
            'name'     => ['caption' => 'Название', 'type' => 'text', 'layout' => 'col-3'],
            'price'    => ['caption' => 'Цена (число)', 'type' => 'text', 'layout' => 'col-3'],
            'featured' => ['caption' => 'Выделить', 'type' => 'dropdown', 'layout' => 'col-3', 'elements' => ['' => 'Нет', '1' => 'Да'], 'default' => ''],
            'badge'    => ['caption' => 'Бейдж', 'type' => 'text', 'layout' => 'col-3'],
            'for'      => ['caption' => 'Для кого', 'type' => 'text'],
            'features' => ['caption' => 'Состав (по строке на пункт)', 'type' => 'textarea'],
            'btn_text' => ['caption' => 'Текст кнопки', 'type' => 'text', 'layout' => 'col-6'],
            'btn_link' => ['caption' => 'Ссылка кнопки', 'type' => 'text', 'layout' => 'col-6'],
        ]],
        'note'    => ['caption' => 'Примечание', 'type' => 'text'],
    ],
];

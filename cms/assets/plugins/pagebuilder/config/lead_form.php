<?php

return [
    'title'     => 'Форма заявки',
    'container' => 'default',
    'order'     => 8,
    'fields'    => [
        'eyebrow'         => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-6', 'default' => 'Заявка за минуту'],
        'heading'         => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-6'],
        'lead'            => ['caption' => 'Подводка', 'type' => 'textarea'],
        'checks'          => ['caption' => 'Чек-лист', 'type' => 'group', 'fields' => [
            'text' => ['caption' => 'Пункт', 'type' => 'text'],
        ]],
        'chips'           => ['caption' => 'Варианты «Что интересует?»', 'type' => 'group', 'fields' => [
            'text' => ['caption' => 'Вариант', 'type' => 'text'],
        ]],
        'btn_text'        => ['caption' => 'Текст кнопки', 'type' => 'text', 'layout' => 'col-6', 'default' => 'Получить расчёт'],
        'show_messengers' => ['caption' => 'Кнопки мессенджеров', 'type' => 'dropdown', 'layout' => 'col-6', 'elements' => ['1' => 'Показывать', '' => 'Скрыть'], 'default' => '1'],
    ],
];

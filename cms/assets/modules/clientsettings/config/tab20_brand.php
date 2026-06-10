<?php

return [
    'caption'   => 'Бренд и тексты',
    'introtext' => 'Название, логотип-текст, подписи в шапке и подвале.',
    'settings'  => [
        'org_name'             => ['caption' => 'Название организации', 'type' => 'text', 'default_text' => 'Космос Детейлинг Студия'],
        'brand_top'            => ['caption' => 'Лого: верхняя строка', 'type' => 'text', 'default_text' => 'КОСМОС'],
        'brand_sub'            => ['caption' => 'Лого: подпись', 'type' => 'text', 'default_text' => 'detailing studio'],
        'header_cta_text'      => ['caption' => 'Кнопка в шапке — текст', 'type' => 'text', 'default_text' => 'Рассчитать'],
        'header_cta_text_long' => ['caption' => 'Кнопка в моб. меню — текст', 'type' => 'text', 'default_text' => 'Рассчитать стоимость'],
        'header_cta_link'      => ['caption' => 'Кнопка в шапке — ссылка', 'type' => 'text', 'default_text' => '#zayavka'],
        'footer_about'         => ['caption' => 'Текст о студии в подвале', 'type' => 'textarea', 'default_text' => 'Премиальный детейлинг на Васильевском острове. Фиксированная смета, фото/видео-отчёт и гарантия результата.'],
        'copyright'            => ['caption' => 'Копирайт', 'type' => 'text', 'default_text' => 'Космос Детейлинг Студия · Санкт-Петербург'],
        'privacy_link'         => ['caption' => 'Ссылка на политику конфиденциальности', 'type' => 'text', 'default_text' => '#'],
        'area_served'          => ['caption' => 'Зона обслуживания (schema.org)', 'type' => 'text', 'default_text' => 'Санкт-Петербург, Василеостровский район'],
        'price_range'          => ['caption' => 'Ценовой сегмент (schema.org)', 'type' => 'text', 'default_text' => '₽₽₽'],
        'og_image_default'     => ['caption' => 'OG-изображение по умолчанию', 'type' => 'image', 'default_text' => 'assets/img/work-004.jpg'],
    ],
];

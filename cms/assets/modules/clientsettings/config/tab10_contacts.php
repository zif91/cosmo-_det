<?php

return [
    'caption'   => 'Контакты студии',
    'introtext' => 'Телефон, адрес, мессенджеры — используются в шапке, подвале, на странице «Контакты» и в SEO-разметке.',
    'settings'  => [
        'phone'          => ['caption' => 'Телефон (для ссылок)', 'type' => 'text', 'default_text' => '+79310000000', 'note' => 'Формат +79xxxxxxxxx'],
        'phone_display'  => ['caption' => 'Телефон (как показывать)', 'type' => 'text', 'default_text' => '+7 (931) 000-00-00'],
        'whatsapp'       => ['caption' => 'Ссылка WhatsApp', 'type' => 'url', 'default_text' => 'https://wa.me/79310000000'],
        'telegram'       => ['caption' => 'Ссылка Telegram', 'type' => 'url', 'default_text' => 'https://t.me/kosmos_detail'],
        'vk'             => ['caption' => 'Ссылка ВКонтакте', 'type' => 'url'],
        'email'          => ['caption' => 'E-mail студии', 'type' => 'email', 'default_text' => 'info@kosmos-detail.ru'],
        'address_short'  => ['caption' => 'Адрес (коротко, подвал)', 'type' => 'text', 'default_text' => 'СПб, ул. Кораблестроителей, 14'],
        'address_full'   => ['caption' => 'Адрес (полностью)', 'type' => 'text', 'default_text' => 'Санкт-Петербург, ул. Кораблестроителей, 14'],
        'street'         => ['caption' => 'Улица, дом (для schema.org)', 'type' => 'text', 'default_text' => 'ул. Кораблестроителей, 14'],
        'postal_code'    => ['caption' => 'Индекс', 'type' => 'text', 'default_text' => '199397'],
        'worktime'       => ['caption' => 'Режим работы (коротко)', 'type' => 'text', 'default_text' => 'Ежедневно 10:00 – 22:00'],
        'worktime_full'  => ['caption' => 'Режим работы (полностью)', 'type' => 'text', 'default_text' => 'Ежедневно, 10:00 – 22:00 · по записи'],
        'opens'          => ['caption' => 'Открытие (HH:MM)', 'type' => 'text', 'default_text' => '10:00'],
        'closes'         => ['caption' => 'Закрытие (HH:MM)', 'type' => 'text', 'default_text' => '22:00'],
        'geo_lat'        => ['caption' => 'Широта', 'type' => 'text', 'default_text' => '59.9690'],
        'geo_lon'        => ['caption' => 'Долгота', 'type' => 'text', 'default_text' => '30.2090'],
        'map_embed'      => ['caption' => 'URL виджета Яндекс-карты', 'type' => 'textarea', 'default_text' => 'https://yandex.ru/map-widget/v1/?ll=30.209%2C59.969&z=15&mode=search&text=%D0%A1%D0%B0%D0%BD%D0%BA%D1%82-%D0%9F%D0%B5%D1%82%D0%B5%D1%80%D0%B1%D1%83%D1%80%D0%B3%2C%20%D1%83%D0%BB%D0%B8%D1%86%D0%B0%20%D0%9A%D0%BE%D1%80%D0%B0%D0%B1%D0%BB%D0%B5%D1%81%D1%82%D1%80%D0%BE%D0%B8%D1%82%D0%B5%D0%BB%D0%B5%D0%B9%2C%2014'],
    ],
];

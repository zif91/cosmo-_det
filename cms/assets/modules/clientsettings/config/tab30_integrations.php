<?php

return [
    'caption'   => 'Интеграции и заявки',
    'introtext' => 'Куда отправлять заявки с форм и счётчики аналитики.',
    'settings'  => [
        'lead_email'          => ['caption' => 'E-mail для заявок', 'type' => 'email', 'default_text' => 'info@kosmos-detail.ru'],
        'lead_telegram_token' => ['caption' => 'Telegram-бот: токен', 'type' => 'text', 'note' => 'Опционально: дублировать заявки в Telegram'],
        'lead_telegram_chat'  => ['caption' => 'Telegram: chat_id', 'type' => 'text'],
        'header_codes'        => ['caption' => 'Коды в <head> (метрика и т.п.)', 'type' => 'textarea'],
        'footer_codes'        => ['caption' => 'Коды перед </body>', 'type' => 'textarea'],
    ],
];

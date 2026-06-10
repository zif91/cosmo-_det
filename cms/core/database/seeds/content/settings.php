<?php

/**
 * Системные настройки + значения ClientSettings по умолчанию.
 * ClientSettings (prefix client_) хранит значения в той же таблице system_settings —
 * сидируем их сразу, чтобы сайт корректно работал до первого сохранения модуля.
 */
return [
    // --- система ---
    'site_name'           => 'Космос Детейлинг Студия',
    'site_start'          => '1',
    'error_page'          => '9',
    'unauthorized_page'   => '9',
    'friendly_urls'       => '1',
    'friendly_alias_urls' => '1',
    'use_alias_path'      => '1',
    'friendly_url_suffix' => '.html',
    'seostrict'           => '1',
    'automatic_alias'     => '1',
    'modx_charset'        => 'UTF-8',

    // --- контакты ---
    'client_phone'          => '+79310000000',
    'client_phone_display'  => '+7 (931) 000-00-00',
    'client_whatsapp'       => 'https://wa.me/79310000000',
    'client_telegram'       => 'https://t.me/kosmos_detail',
    'client_vk'             => '',
    'client_email'          => 'info@kosmos-detail.ru',
    'client_address_short'  => 'СПб, ул. Кораблестроителей, 14',
    'client_address_full'   => 'Санкт-Петербург, ул. Кораблестроителей, 14',
    'client_street'         => 'ул. Кораблестроителей, 14',
    'client_postal_code'    => '199397',
    'client_worktime'       => 'Ежедневно 10:00 – 22:00',
    'client_worktime_full'  => 'Ежедневно, 10:00 – 22:00 · по записи',
    'client_opens'          => '10:00',
    'client_closes'         => '22:00',
    'client_geo_lat'        => '59.9690',
    'client_geo_lon'        => '30.2090',
    'client_map_embed'      => 'https://yandex.ru/map-widget/v1/?ll=30.209%2C59.969&z=15&mode=search&text=%D0%A1%D0%B0%D0%BD%D0%BA%D1%82-%D0%9F%D0%B5%D1%82%D0%B5%D1%80%D0%B1%D1%83%D1%80%D0%B3%2C%20%D1%83%D0%BB%D0%B8%D1%86%D0%B0%20%D0%9A%D0%BE%D1%80%D0%B0%D0%B1%D0%BB%D0%B5%D1%81%D1%82%D1%80%D0%BE%D0%B8%D1%82%D0%B5%D0%BB%D0%B5%D0%B9%2C%2014',

    // --- бренд и тексты ---
    'client_org_name'             => 'Космос Детейлинг Студия',
    'client_brand_top'            => 'КОСМОС',
    'client_brand_sub'            => 'detailing studio',
    'client_header_cta_text'      => 'Рассчитать',
    'client_header_cta_text_long' => 'Рассчитать стоимость',
    'client_header_cta_link'      => '#zayavka',
    'client_footer_about'         => 'Премиальный детейлинг на Васильевском острове. Фиксированная смета, фото/видео-отчёт и гарантия результата.',
    'client_copyright'            => 'Космос Детейлинг Студия · Санкт-Петербург',
    'client_privacy_link'         => '#',
    'client_area_served'          => 'Санкт-Петербург, Василеостровский район',
    'client_price_range'          => '₽₽₽',
    'client_og_image_default'     => 'assets/img/work-004.jpg',

    // --- интеграции ---
    'client_lead_email'          => 'info@kosmos-detail.ru',
    'client_lead_telegram_token' => '',
    'client_lead_telegram_chat'  => '',
    'client_header_codes'        => '',
    'client_footer_codes'        => '',
];

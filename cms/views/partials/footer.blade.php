@php
    $cfg     = fn ($key, $default = '') => evo()->getConfig($key, $default);
    $homeUrl = UrlProcessor::makeUrl(evo()->getConfig('site_start'));
@endphp
<footer class="site-footer">
  <div class="wrap">
    <div class="foot-grid">
      <div class="foot-about">
        @include('partials.brand')
        <p>{{ $cfg('client_footer_about', 'Премиальный детейлинг на Васильевском острове. Фиксированная смета, фото/видео-отчёт и гарантия результата.') }}</p>
        <div class="socials">
          @if($cfg('client_whatsapp'))<a href="{{ $cfg('client_whatsapp') }}" aria-label="WhatsApp" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2z"/></svg></a>@endif
          @if($cfg('client_telegram'))<a href="{{ $cfg('client_telegram') }}" aria-label="Telegram" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M21.94 4.5L18.6 20c-.25 1.1-.92 1.37-1.86.85l-5.14-3.79-2.48 2.39c-.27.27-.5.5-1.03.5l.37-5.23L17.1 6.1c.42-.37-.09-.58-.65-.21L6.16 12.5l-5.06-1.58c-1.1-.34-1.12-1.1.23-1.63l19.78-7.62c.92-.34 1.72.22 1.43 1.61z"/></svg></a>@endif
          @if($cfg('client_vk'))<a href="{{ $cfg('client_vk') }}" aria-label="ВКонтакте" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M13.16 18.1c-7.3 0-11.46-5-11.64-13.3h3.66c.12 6.1 2.8 8.68 4.93 9.2V4.8h3.45v5.28c2.1-.22 4.3-2.6 5.04-5.28h3.45c-.57 3.3-2.95 5.68-4.64 6.66 1.69.8 4.4 2.87 5.43 6.64h-3.8c-.8-2.5-2.82-4.43-5.48-4.7v4.7h-.41z"/></svg></a>@endif
        </div>
      </div>
      <div><h4>Услуги</h4><ul>
        @foreach($servicemenu ?? [] as $item)
          <li><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
        @endforeach
      </ul></div>
      <div><h4>Студия</h4><ul>
        <li><a href="{{ $homeUrl }}#o-studii">О студии</a></li>
        <li><a href="{{ $homeUrl }}#pakety">Пакеты</a></li>
        <li><a href="{{ $homeUrl }}#raboty">Наши работы</a></li>
        <li><a href="{{ $homeUrl }}#faq">Вопросы и ответы</a></li>
        @if(!empty($contactsurl))<li><a href="{{ $contactsurl }}">Контакты</a></li>@endif
      </ul></div>
      <div class="foot-contacts"><h4>Контакты</h4>
        <div class="c"><span>Адрес</span><b>{{ $cfg('client_address_short', 'СПб, ул. Кораблестроителей, 14') }}</b></div>
        <div class="c"><span>Телефон</span><b><a href="tel:{{ $cfg('client_phone') }}">{{ $cfg('client_phone_display') }}</a></b></div>
        <div class="c"><span>Почта</span><b><a href="mailto:{{ $cfg('client_email') }}">{{ $cfg('client_email') }}</a></b></div>
        <div class="c"><span>Режим работы</span><b>{{ $cfg('client_worktime', 'Ежедневно 10:00 – 22:00') }}</b></div>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© <span data-year>{{ date('Y') }}</span> {{ $cfg('client_copyright', 'Космос Детейлинг Студия · Санкт-Петербург') }}</span>
      <span>{{ parse_url($cfg('site_url'), PHP_URL_HOST) }} · <a href="{{ $cfg('client_privacy_link', '#') }}">Политика конфиденциальности</a></span>
    </div>
  </div>
</footer>

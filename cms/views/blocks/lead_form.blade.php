@php
    $wa = evo()->getConfig('client_whatsapp');
    $tg = evo()->getConfig('client_telegram');
@endphp
<section class="section" id="zayavka">
  <div class="wrap">
    <div class="split">
      <div data-reveal>
        <span class="eyebrow">{!! $b['eyebrow'] !!}</span>
        <h2 class="h-xl" style="margin-top:16px">{!! $b['heading'] !!}</h2>
        <p class="lead" style="margin-top:18px">{!! $b['lead'] !!}</p>
        @if(!empty($b['checks']))
        <ul class="check-list">
          @foreach($b['checks'] as $check)
          <li>@include('partials.icon-check')<span>{!! $check['text'] !!}</span></li>
          @endforeach
        </ul>
        @endif
        @if(($b['show_messengers'] ?? '1') && ($wa || $tg))
        <div class="hero-cta" style="margin-top:30px">
          @if($wa)<a href="{{ $wa }}" class="btn btn-wa" target="_blank" rel="noopener">@include('partials.icon-wa')WhatsApp</a>@endif
          @if($tg)<a href="{{ $tg }}" class="btn btn-ghost" target="_blank" rel="noopener">@include('partials.icon-tg')Telegram</a>@endif
        </div>
        @endif
      </div>
      <div class="lead-form" data-reveal data-d="1">
        <form data-lead>
          <div class="field"><label>Что интересует?</label>
            <div class="chips" data-multi="true">
              @foreach($b['chips'] ?? [] as $chip)<span class="chip">{{ $chip['text'] }}</span>@endforeach
            </div>
          </div>
          <div class="field"><label for="nm">Ваше имя</label><input id="nm" name="name" type="text" placeholder="Как к вам обращаться" required></div>
          <div class="field"><label for="ph">Телефон</label><input id="ph" name="phone" type="tel" placeholder="+7 (___) ___-__-__" required></div>
          <div class="field"><label for="car">Автомобиль (необязательно)</label><input id="car" name="car" type="text" placeholder="Марка, модель, год"></div>
          <button type="submit" class="btn btn-primary btn-block btn-lg">{{ $b['btn_text'] ?: 'Получить расчёт' }}</button>
          <p class="form-note">Нажимая кнопку, вы соглашаетесь с обработкой персональных данных.</p>
        </form>
        <div class="form-ok">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-6"/></svg></div>
          <h3 class="h-md">Заявка отправлена!</h3>
          <p class="muted" style="margin-top:10px">Мы свяжемся с вами в ближайшее время. Хорошего дня ✦</p>
        </div>
      </div>
    </div>
  </div>
</section>

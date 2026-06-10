<section class="section section-tight" id="booking">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <span class="eyebrow">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-xl">{!! $b['heading'] !!}</h2>
      @if($b['text'])<p>{!! $b['text'] !!}</p>@endif
    </div>
    <div class="panel" data-reveal style="padding:clamp(22px,3vw,40px)">
      <div class="book-grid">
        <div>
          <div class="book-step">
            <div class="st-h"><span class="n">1</span><h4>Услуга</h4></div>
            <div class="svc-chips" id="bk-services"></div>
          </div>
          <div class="book-step">
            <div class="st-h"><span class="n">2</span><h4>Дата</h4></div>
            <div class="day-pills" id="bk-days"></div>
          </div>
          <div class="book-step" style="margin-bottom:0">
            <div class="st-h"><span class="n">3</span><h4>Свободное окошко</h4></div>
            <div class="slot-grid" id="bk-slots"></div>
          </div>
        </div>
        <aside class="book-summary">
          <h3>Ваша запись</h3>
          <div class="sl"><span class="ic">✦ Услуга</span><span class="vv empty" id="sm-svc">—</span></div>
          <div class="sl"><span class="ic">✦ Дата</span><span class="vv empty" id="sm-day">—</span></div>
          <div class="sl"><span class="ic">✦ Время</span><span class="vv empty" id="sm-slot">—</span></div>
          <form id="bk-form" class="bk-fields">
            <input id="bk-name" name="name" type="text" placeholder="Ваше имя" required>
            <input id="bk-phone" name="phone" type="tel" placeholder="+7 (___) ___-__-__" required>
            <p id="bk-warn" class="form-note" style="display:none;color:#e58e8e">Выберите услугу, дату и время.</p>
            <button type="submit" class="btn btn-primary btn-block btn-lg">{{ $b['btn_text'] ?: 'Записаться' }}</button>
            <p class="form-note">Нажимая кнопку, вы соглашаетесь с обработкой персональных данных.</p>
          </form>
          <div id="bk-ok" style="display:none;text-align:center;padding:8px 0">
            <div style="width:58px;height:58px;margin:0 auto 14px;color:var(--gold)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-6"/></svg></div>
            <h3 class="h-md">Вы записаны!</h3>
            <p class="muted" id="bk-ok-text" style="margin-top:8px"></p>
            <p class="muted" style="margin-top:6px;font-size:.85rem">Мы перезвоним для подтверждения ✦</p>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>

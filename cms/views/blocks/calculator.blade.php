<section class="section section-tight" id="calculator">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <span class="eyebrow">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-xl">{!! $b['heading'] !!}</h2>
      @if($b['text'])<p>{!! $b['text'] !!}</p>@endif
    </div>
    <div class="seg" id="calc-modes" data-reveal style="margin-bottom:24px">
      <button class="active" data-mode="detail">{{ $b['mode1_label'] ?: 'Детейлинг и защита' }}</button>
      <button data-mode="gost">{{ $b['mode2_label'] ?: 'Ремонт сколов · ГОСТ' }}</button>
    </div>
    <div id="calc-mode-detail" data-reveal>
      <div class="calc-grid">
        <div>
          <div class="calc-step-label">Этап 1 · класс кузова</div>
          <div class="calc-h">Габаритный класс вашего авто</div>
          <div class="class-grid" id="calc-classes"></div>
          <div class="calc-step-label">Этап 2 · услуги</div>
          <div class="calc-h">Выберите необходимые работы</div>
          <div class="svc-list" id="calc-services"></div>
        </div>
        <aside class="estimate">
          <h3>Предварительная смета</h3>
          <div class="lines" id="est-lines"></div>
          <div class="meta-row"><span>Класс авто</span><b id="est-class">—</b></div>
          <div class="meta-row"><span>Время на стенде</span><b id="est-time">—</b></div>
          <div class="meta-row"><span>Гарантия</span><b>включена</b></div>
          <div class="total"><span>Итого с учётом класса</span><b id="est-total">0 ₽</b></div>
          <p class="note">{!! $b['note'] ?: '* Ориентировочно. Точная смета — после бесплатного осмотра.' !!}</p>
          <a href="#booking" class="btn btn-primary btn-block" data-book-to="Оклейка PPF">Перейти к записи →</a>
        </aside>
      </div>
    </div>
    <div id="calc-mode-gost" data-reveal style="display:none">
      <div class="gost-grid">
        <div>
          <div class="calc-step-label">HUD-синтезатор стекла</div>
          <div class="calc-h">Параметры повреждения лобового</div>
          <div class="stepper"><span class="ab">A</span><span class="lab">Сколы (точки удара)<small>базовая герметизация</small></span><span class="ctrl"><button data-step="A:-1">−</button><span class="val" id="g-A">1 шт.</span><button data-step="A:1">+</button></span></div>
          <div class="stepper"><span class="ab">B</span><span class="lab">Лучи трещин<small>высверливание</small></span><span class="ctrl"><button data-step="B:-1">−</button><span class="val" id="g-B">2 луч.</span><button data-step="B:1">+</button></span></div>
          <div class="stepper"><span class="ab">C</span><span class="lab">Суммарная длина лучей<small>полимеризация</small></span><span class="ctrl"><button data-step="C:-5">−</button><span class="val" id="g-C">10 мм</span><button data-step="C:5">+</button></span></div>
          <div class="formula">Формула: цена = сколы × 1000 ₽ + лучи × 300 ₽ + длина(мм) × 150 ₽</div>
        </div>
        <aside class="estimate">
          <h3>Смета ремонта по ГОСТ</h3>
          <div class="lines" id="gost-breakdown"></div>
          <div class="meta-row"><span>Фотополимер</span><b>оптический, США</b></div>
          <div class="meta-row"><span>Время</span><b>~ 40–60 мин</b></div>
          <div class="meta-row"><span>Гарантия</span><b>включена</b></div>
          <div class="total"><span>Итого</span><b id="gost-total">0 ₽</b></div>
          <p class="note">* Включая вакуумирование и сушку. Возврат прозрачности 95–98%.</p>
          <a href="#booking" class="btn btn-primary btn-block" data-book-to="Защита фар и стекла">Записаться на ремонт →</a>
        </aside>
      </div>
    </div>
  </div>
</section>

/* ============================================================
   КОСМОС ДЕТЕЙЛИНГ — interactions
   ============================================================ */
(function () {
  "use strict";
  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s));
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------- Header scroll state ---------- */
  const header = $(".site-header");
  const onScroll = () => header && header.classList.toggle("scrolled", window.scrollY > 30);
  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });

  /* ---------- Mobile menu ---------- */
  const burger = $(".burger");
  const menu = $(".mobile-menu");
  if (burger && menu) {
    const toggle = (open) => {
      burger.classList.toggle("open", open);
      menu.classList.toggle("open", open);
      document.body.style.overflow = open ? "hidden" : "";
    };
    burger.addEventListener("click", () => toggle(!menu.classList.contains("open")));
    $$("a", menu).forEach((a) => a.addEventListener("click", () => toggle(false)));
  }

  /* ---------- Scroll reveal ---------- */
  const reveals = $$("[data-reveal]");
  if (reveals.length && "IntersectionObserver" in window && !reduce) {
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) {
            e.target.classList.add("in");
            io.unobserve(e.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: "0px 0px -8% 0px" }
    );
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("in"));
  }

  /* ---------- Animated counters ---------- */
  const counters = $$("[data-count]");
  if (counters.length && "IntersectionObserver" in window) {
    const cio = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;
          const el = e.target;
          const target = parseFloat(el.dataset.count);
          const suffix = el.dataset.suffix || "";
          const dur = 1600;
          const start = performance.now();
          const tick = (now) => {
            const p = Math.min((now - start) / dur, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            const val = target * eased;
            el.textContent =
              (Number.isInteger(target) ? Math.round(val) : val.toFixed(1)).toLocaleString("ru-RU") + suffix;
            if (p < 1) requestAnimationFrame(tick);
          };
          if (reduce) el.textContent = target.toLocaleString("ru-RU") + suffix;
          else requestAnimationFrame(tick);
          cio.unobserve(el);
        });
      },
      { threshold: 0.5 }
    );
    counters.forEach((c) => cio.observe(c));
  }

  /* ---------- FAQ accordion ---------- */
  $$(".qa").forEach((qa) => {
    const btn = $("button", qa);
    const ans = $(".ans", qa);
    if (!btn || !ans) return;
    btn.addEventListener("click", () => {
      const open = qa.classList.contains("open");
      $$(".qa.open").forEach((o) => {
        o.classList.remove("open");
        $(".ans", o).style.maxHeight = null;
      });
      if (!open) {
        qa.classList.add("open");
        ans.style.maxHeight = ans.scrollHeight + "px";
      }
    });
  });

  /* ---------- Quiz chips (single/multi) ---------- */
  $$(".chips").forEach((group) => {
    const multi = group.dataset.multi === "true";
    $$(".chip", group).forEach((chip) => {
      chip.addEventListener("click", () => {
        if (multi) chip.classList.toggle("active");
        else {
          $$(".chip", group).forEach((c) => c.classList.remove("active"));
          chip.classList.add("active");
        }
      });
    });
  });

  /* ---------- Lead form (демо-отправка) ---------- */
  $$("form[data-lead]").forEach((form) => {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const ok = $(".form-ok", form.parentElement) || $(".form-ok", form);
      form.style.display = "none";
      if (ok) ok.classList.add("show");
    });
  });

  /* ---------- Lightbox gallery ---------- */
  const shots = $$(".gallery .shot");
  if (shots.length) {
    const lb = document.createElement("div");
    lb.className = "lightbox";
    lb.innerHTML =
      '<button class="lb-btn lb-close" aria-label="Закрыть"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22"><path d="M6 6l12 12M18 6L6 18"/></svg></button>' +
      '<button class="lb-btn lb-prev" aria-label="Назад"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22"><path d="M15 6l-6 6 6 6"/></svg></button>' +
      '<img alt="Работа Космос Детейлинг">' +
      '<button class="lb-btn lb-next" aria-label="Вперёд"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22"><path d="M9 6l6 6-6 6"/></svg></button>' +
      '<div class="lb-count"></div>';
    document.body.appendChild(lb);
    const lbImg = $("img", lb);
    const lbCount = $(".lb-count", lb);
    const srcs = shots.map((s) => $("img", s).dataset.full || $("img", s).src);
    let idx = 0;
    const show = (i) => {
      idx = (i + srcs.length) % srcs.length;
      lbImg.src = srcs[idx];
      lbCount.textContent = idx + 1 + " / " + srcs.length;
    };
    const open = (i) => {
      show(i);
      lb.classList.add("open");
      document.body.style.overflow = "hidden";
    };
    const close = () => {
      lb.classList.remove("open");
      document.body.style.overflow = "";
    };
    shots.forEach((s, i) => s.addEventListener("click", () => open(i)));
    $(".lb-close", lb).addEventListener("click", close);
    $(".lb-next", lb).addEventListener("click", () => show(idx + 1));
    $(".lb-prev", lb).addEventListener("click", () => show(idx - 1));
    lb.addEventListener("click", (e) => {
      if (e.target === lb) close();
    });
    document.addEventListener("keydown", (e) => {
      if (!lb.classList.contains("open")) return;
      if (e.key === "Escape") close();
      if (e.key === "ArrowRight") show(idx + 1);
      if (e.key === "ArrowLeft") show(idx - 1);
    });
  }

  /* ---------- Hero parallax (лёгкий) ---------- */
  const heroMedia = $(".hero-media img");
  if (heroMedia && !reduce) {
    window.addEventListener(
      "scroll",
      () => {
        const y = window.scrollY;
        if (y < window.innerHeight) heroMedia.style.transform = "translate3d(0," + y * 0.18 + "px,0) scale(1.06)";
      },
      { passive: true }
    );
  }

  /* ---------- Starfield canvas (тонкий, не планетарий) ---------- */
  const canvas = $("#stars");
  if (canvas && !reduce) {
    const ctx = canvas.getContext("2d");
    let w, h, stars, dpr;
    const init = () => {
      dpr = Math.min(window.devicePixelRatio || 1, 2);
      w = canvas.width = innerWidth * dpr;
      h = canvas.height = innerHeight * dpr;
      canvas.style.width = innerWidth + "px";
      canvas.style.height = innerHeight + "px";
      const count = Math.min(120, Math.floor((innerWidth * innerHeight) / 14000));
      stars = Array.from({ length: count }, () => ({
        x: Math.random() * w,
        y: Math.random() * h,
        r: (Math.random() * 1.2 + 0.2) * dpr,
        a: Math.random() * 0.6 + 0.2,
        tw: Math.random() * 0.02 + 0.004,
        ph: Math.random() * Math.PI * 2,
        gold: Math.random() > 0.82,
      }));
    };
    const draw = (t) => {
      ctx.clearRect(0, 0, w, h);
      for (const s of stars) {
        const tw = s.a + Math.sin(t * s.tw + s.ph) * 0.25;
        ctx.beginPath();
        ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
        ctx.fillStyle = s.gold
          ? "rgba(230,207,154," + Math.max(0, tw) + ")"
          : "rgba(255,255,255," + Math.max(0, tw) + ")";
        ctx.fill();
      }
      requestAnimationFrame(draw);
    };
    init();
    requestAnimationFrame(draw);
    let rt;
    window.addEventListener("resize", () => {
      clearTimeout(rt);
      rt = setTimeout(init, 200);
    });
  }

  /* ---------- Active nav by current page ---------- */
  const path = location.pathname.split("/").pop() || "index.html";
  $$(".nav a, .mobile-menu a").forEach((a) => {
    const href = a.getAttribute("href");
    if (href === path || (path === "index.html" && href === "index.html")) a.classList.add("active");
  });

  /* ---------- Year ---------- */
  $$("[data-year]").forEach((el) => (el.textContent = new Date().getFullYear()));

  /* Сигнал, что скрипт успешно отработал — отключает failsafe-показ контента из <head> */
  window.__kosmosReady = true;
})();

/* ============================================================
   РАДАР ЗОН · КАЛЬКУЛЯТОР · ОНЛАЙН-ЗАПИСЬ
   ============================================================ */
(function () {
  "use strict";
  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s));
  const rub = (n) => Math.round(n).toLocaleString("ru-RU") + " ₽";
  const days = (d) => (d % 1 ? d.toFixed(1) : d).toString().replace(".", ",");

  /* ---------------- РАДАР ЗОН ---------------- */
  const ZONES = [
    { id:"hood", tab:"1 · Морда и оптика", risk:"95% риска сколов", title:"Фронтальный бронещит (капот и оптика)",
      desc:"Передняя часть принимает на себя весь летящий гравий, пескоструй на скорости и реагенты зимой. Заводское ЛКП беззащитно перед сколами до металла, с которых начинается коррозия.",
      params:[["Толщина защиты","85 мкм","285 мкм"],["Сопротивление сколам","Низкое","Абсолют"],["Самовосстановление","Отсутствует","до +60 °C"]],
      reco:"Бронирование сертифицированным полиуретаном (200 мкм) с ювелирным подворотом краёв без стыков.", phases:1, service:"ppf_front" },
    { id:"windshield", tab:"2 · Лобовое стекло", risk:"угроза сквозных трещин", title:"Лобовое остекление и триплекс",
      desc:"Стекло затирается жёсткими щётками, мутнеет от кремния и даёт сквозные трещины даже от мелких сколов на трассе. Замена — это дорого и долго.",
      params:[["Прочность стекла","1× (база)","4.5× жёстче"],["Отсечение УФ","15%","99.8%"],["Угол схода капель","42°","115°"]],
      reco:"Бронирование оптической плёнкой + гидрофобная обработка стекла. Защищает от камней и улучшает обзор в дождь.", phases:2, service:"glass" },
    { id:"sides", tab:"3 · Борта и ЛКП", risk:"потеря глубины цвета", title:"Периметр ЛКП (двери, зеркала, стойки)",
      desc:"Боковые панели страдают от бесконтактных моек с агрессивной химией, соляных колей и парковочных притирок. Лак мутнеет, уходит глубина цвета и металлический отлив.",
      params:[["Глянец поверхности","81 GU","98.5 GU"],["Самоочищение","Собирает грязь","Гидрофоб"],["Срок барьера","0 мес","до 36 мес"]],
      reco:"Мягкая полировка профессиональными пастами + запечатывание кузова керамикой в несколько слоёв.", phases:2, service:"polish_cer" },
    { id:"interior", tab:"4 · Кожаный салон", risk:"микротрещины и выгорание", title:"Кокпит и кожаный салон",
      desc:"Мягкая кожа выгорает, пересыхает и окрашивается от джинсовой одежды, покрывается микротрещинами. В воздуховодах копятся аллергены.",
      params:[["Увлажнённость кожи","11% (сухая)","22% (эластичная)"],["Защита от окрашивания","Отсутствует","100%"],["Чистота воздуха","Бактерии","99.9% очистка"]],
      reco:"Глубокая гипоаллергенная химчистка + консервация кожи эластичными уретановыми кремами.", phases:2, service:"leather" },
    { id:"wheels", tab:"5 · Колёса и оптика", risk:"термический вжиг", title:"Диски и тормозная система",
      desc:"Раскалённая металлическая стружка от колодок (до 600 °C) вплавляется в лак дисков. Обычная мойка её не убирает — начинается коррозия и потеря блеска.",
      params:[["Термостойкость слоя","120 °C","850 °C"],["Отталкивание пыли","0%","92% барьер"],["Лёгкость мытья","Сложная химия","Сбивается водой"]],
      reco:"Химическая дезактивация дисков + стойкое керамическое покрытие, запекаемое под лампами.", phases:1, service:"ceramic_pro" },
  ];
  const diag = $("#radar-diag");
  if (diag) {
    const tabsWrap = $("#radar-tabs");
    const hots = $$(".hot");
    const render = (z) => {
      diag.innerHTML =
        '<span class="risk">◇ Зона риска — <b>' + z.risk + "</b></span>" +
        "<h3>" + z.title + "</h3>" +
        '<p class="desc">' + z.desc + "</p>" +
        '<div class="pp-title">◄ Технические параметры · до / после</div>' +
        '<div class="bna">' + z.params.map((p) =>
          '<div class="row"><span class="k">' + p[0] + '</span><span class="v"><span class="before">' + p[1] + '</span><span class="arrow">→</span><span class="after">' + p[2] + "</span></span></div>"
        ).join("") + "</div>" +
        '<div class="reco"><b>Рекомендация технолога</b>' + z.reco + "</div>" +
        '<div class="diag-cta"><a href="#calculator" class="btn btn-primary" data-zone-service="' + z.service + '">Защитить зону в смете</a><span class="phases">Добавит фаз: <b>' + z.phases + "</b></span></div>";
    };
    const select = (id) => {
      const z = ZONES.find((x) => x.id === id) || ZONES[0];
      $$("#radar-tabs button").forEach((b) => b.classList.toggle("active", b.dataset.zone === id));
      hots.forEach((h) => h.classList.toggle("active", h.dataset.zone === id));
      render(z);
    };
    if (tabsWrap) tabsWrap.innerHTML = ZONES.map((z, i) =>
      '<button data-zone="' + z.id + '"' + (i === 0 ? ' class="active"' : "") + ">" + z.tab + "</button>"
    ).join("");
    $$("#radar-tabs button").forEach((b) => b.addEventListener("click", () => select(b.dataset.zone)));
    hots.forEach((h) => h.addEventListener("click", () => select(h.dataset.zone)));
    select("hood");
    // делегируем клик по CTA зоны -> выбрать услугу в калькуляторе
    diag.addEventListener("click", (e) => {
      const a = e.target.closest("[data-zone-service]");
      if (a) window.__preselectService = a.dataset.zoneService;
    });
  }

  /* ---------------- КАЛЬКУЛЯТОР ---------------- */
  const calc = $("#calculator");
  if (calc) {
    const CLASSES_FALLBACK = [
      { id:"m", name:"Малый / средний класс", mult:1, eg:"Tesla Model 3, BMW 3, Audi A4, Zeekr X" },
      { id:"p", name:"Premium седан / кроссовер", mult:1.2, eg:"Zeekr 001, BMW 5, Porsche Taycan, Voyah Free" },
      { id:"s", name:"Внедорожник / Big SUV", mult:1.4, eg:"Li L9, BMW X7, Range Rover, Land Cruiser" },
      { id:"c", name:"Спорткар / минивэн", mult:1.3, eg:"Porsche 911, Zeekr 009, Audi R8, Alphard" },
    ];
    const SERVICES_FALLBACK = [
      { id:"ppf_front", name:"Защита «Зоны риска» PPF", sub:"Полиуретан на перёд: капот, бампер, фары, зеркала", price:50000, d:2 },
      { id:"ppf_full", name:"Полная оклейка кузова PPF", sub:"Круговая броня, самовосстановление царапин", price:200000, d:4 },
      { id:"polish_cer", name:"Деликатная полировка + керамика 2 слоя", sub:"Глубокий блеск и защита на сезон", price:35000, d:2 },
      { id:"polish_corr", name:"Восстановительная полировка кузова", sub:"Удаление царапин, голограмм, водного камня", price:14000, d:1 },
      { id:"ceramic_pro", name:"Керамика премиум (многослойная)", sub:"Максимальная защита и глубина цвета", price:30000, d:2 },
      { id:"chem", name:"Детейлинг-химчистка салона", sub:"Глубокая чистка + озонация, сухой салон", price:12000, d:1 },
      { id:"leather", name:"Реставрация и защита кожи", sub:"Чистка, восстановление, консервация", price:12000, d:1 },
      { id:"glass", name:"Бронирование лобового стекла", sub:"Оптическая плёнка от сколов и трещин", price:16000, d:1 },
      { id:"tint", name:"Атермальная тонировка по ГОСТ", sub:"Меньше жары и UV, по нормативам ДПС", price:9000, d:1 },
      { id:"head", name:"Бронирование и полировка фар", sub:"Защита и прозрачность оптики", price:6000, d:1 },
      { id:"aqua", name:"Антидождь на стёкла", sub:"Гидрофоб, рекомендуем в комплексе", price:2000, d:0.5 },
    ];

    // Данные из админки (PageBuilder, блок «Калькулятор») с фолбэком на хардкод, если блок пуст
    let cd = {};
    try {
      const cdEl = document.getElementById("calc-data");
      if (cdEl) cd = JSON.parse(cdEl.textContent) || {};
    } catch (e) { cd = {}; }
    const CLASSES  = (cd.classes  && cd.classes.length)  ? cd.classes  : CLASSES_FALLBACK;
    const SERVICES = (cd.services && cd.services.length) ? cd.services : SERVICES_FALLBACK;
    const G_CHIP = Number(cd.gost && cd.gost.chip) || 1000;
    const G_RAY  = Number(cd.gost && cd.gost.ray)  || 300;
    const G_MM   = Number(cd.gost && cd.gost.mm)   || 150;
    let curClass = "p";
    if (!CLASSES.find((c) => c.id === curClass)) curClass = CLASSES[0].id;
    const sel = new Set(["ppf_front", "polish_cer"].filter((id) => SERVICES.some((s) => s.id === id)));

    const classWrap = $("#calc-classes");
    const svcWrap = $("#calc-services");
    classWrap.innerHTML = CLASSES.map((c) =>
      '<button class="opt' + (c.id === curClass ? " active" : "") + '" data-class="' + c.id + '"><span class="mult">× ' + c.mult + '</span><h4>' + c.name + '</h4><p class="eg">Например: ' + c.eg + '</p><span class="tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="13" height="13"><path d="M20 6L9 17l-5-5"/></svg></span></button>'
    ).join("");
    svcWrap.innerHTML = SERVICES.map((s) =>
      '<button class="svc-row' + (sel.has(s.id) ? " active" : "") + '" data-svc="' + s.id + '"><span class="box"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="13" height="13"><path d="M20 6L9 17l-5-5"/></svg></span><span class="nm"><b>' + s.name + "</b><span>" + s.sub + '</span></span><span class="pr"><b>' + rub(s.price) + "</b><span>~ " + days(s.d) + " дн.</span></span></button>"
    ).join("");

    const out = {
      lines: $("#est-lines"), total: $("#est-total"), cls: $("#est-class"), time: $("#est-time"),
    };
    const recompute = () => {
      const mult = CLASSES.find((c) => c.id === curClass).mult;
      const chosen = SERVICES.filter((s) => sel.has(s.id));
      let sum = 0, dur = 0;
      out.lines.innerHTML = chosen.length
        ? chosen.map((s) => {
            const line = s.price * mult; sum += line; dur += s.d;
            return '<div class="li"><span class="ln">' + s.name + "<small>класс × " + mult + '</small></span><span class="lp">' + rub(line) + "</span></div>";
          }).join("")
        : '<div class="empty">Выберите услуги слева — смета появится здесь.</div>';
      out.total.textContent = rub(sum);
      out.cls.textContent = CLASSES.find((c) => c.id === curClass).name;
      out.time.textContent = chosen.length ? "~ " + days(dur) + " дн." : "—";
    };
    classWrap.addEventListener("click", (e) => {
      const b = e.target.closest("[data-class]"); if (!b) return;
      curClass = b.dataset.class;
      $$("#calc-classes .opt").forEach((o) => o.classList.toggle("active", o.dataset.class === curClass));
      recompute();
    });
    svcWrap.addEventListener("click", (e) => {
      const b = e.target.closest("[data-svc]"); if (!b) return;
      const id = b.dataset.svc;
      sel.has(id) ? sel.delete(id) : sel.add(id);
      b.classList.toggle("active", sel.has(id));
      recompute();
    });
    recompute();

    // приём преселекта услуги из радара
    const applyPreselect = () => {
      if (window.__preselectService && SERVICES.some((s) => s.id === window.__preselectService)) {
        sel.add(window.__preselectService);
        const b = $('#calc-services [data-svc="' + window.__preselectService + '"]');
        if (b) b.classList.add("active");
        window.__preselectService = null;
        recompute();
      }
    };
    document.addEventListener("click", (e) => { if (e.target.closest('[data-zone-service]')) setTimeout(applyPreselect, 50); });

    /* режимы калькулятора */
    $$("#calc-modes button").forEach((b) => b.addEventListener("click", () => {
      const m = b.dataset.mode;
      $$("#calc-modes button").forEach((x) => x.classList.toggle("active", x === b));
      $("#calc-mode-detail").style.display = m === "detail" ? "" : "none";
      $("#calc-mode-gost").style.display = m === "gost" ? "" : "none";
    }));

    /* GOST ремонт сколов */
    const g = { A: 1, B: 2, C: 10 };
    const gostRecalc = () => {
      const chip = g.A * G_CHIP, ray = g.B * G_RAY, len = g.C * G_MM, tot = chip + ray + len;
      $("#g-A").textContent = g.A + " шт.";
      $("#g-B").textContent = g.B + " луч.";
      $("#g-C").textContent = g.C + " мм";
      $("#gost-breakdown").innerHTML =
        '<div class="li"><span class="ln">Герметизация сколов<small>' + g.A + " × " + G_CHIP.toLocaleString("ru-RU") + " ₽</small></span><span class=\"lp\">" + rub(chip) + "</span></div>" +
        '<div class="li"><span class="ln">Высверливание лучей<small>' + g.B + " × " + G_RAY.toLocaleString("ru-RU") + " ₽</small></span><span class=\"lp\">" + rub(ray) + "</span></div>" +
        '<div class="li"><span class="ln">Полимеризация по длине<small>' + g.C + " мм × " + G_MM.toLocaleString("ru-RU") + " ₽</small></span><span class=\"lp\">" + rub(len) + "</span></div>";
      $("#gost-total").textContent = rub(tot);
    };
    $$("#calc-mode-gost [data-step]").forEach((b) => b.addEventListener("click", () => {
      const [k, delta] = b.dataset.step.split(":");
      g[k] = Math.max(k === "A" ? 1 : 0, g[k] + parseInt(delta, 10));
      gostRecalc();
    }));
    gostRecalc();
  }

  /* ---------------- ОНЛАЙН-ЗАПИСЬ ---------------- */
  const book = $("#booking");
  if (book) {
    const SVC = ["Детейлинг-мойка","Полировка кузова","Керамика / защита","Оклейка PPF","Тонировка","Химчистка салона","Реставрация кожи","Защита фар и стекла","Предпродажная подготовка"];
    const SLOTS = ["10:00","12:00","14:00","16:00","18:00","20:00"];
    const WD = ["вс","пн","вт","ср","чт","пт","сб"];
    const MO = ["янв","фев","мар","апр","мая","июн","июл","авг","сен","окт","ноя","дек"];
    const state = { svc: null, day: null, slot: null };

    $("#bk-services").innerHTML = SVC.map((s) => '<span class="c" data-svc="' + s + '">' + s + "</span>").join("");
    // дни: ближайшие 8 (кроме «сегодня» — с завтра)
    const base = new Date();
    const dayList = [];
    for (let i = 1; i <= 8; i++) { const d = new Date(base); d.setDate(base.getDate() + i); dayList.push(d); }
    $("#bk-days").innerHTML = dayList.map((d, i) =>
      '<span class="d" data-day="' + i + '"><small>' + WD[d.getDay()] + "</small>" + d.getDate() + " " + MO[d.getMonth()] + "</span>"
    ).join("");

    const busy = (di, si) => false;
    const renderSlots = () => {
      const di = state.day;
      $("#bk-slots").innerHTML = SLOTS.map((t, si) => {
        const b = di != null && busy(di, si);
        return '<span class="slot' + (b ? " busy" : "") + (state.slot === t && !b ? " active" : "") + '"' + (b ? "" : ' data-slot="' + t + '"') + ">" + (b ? "занято" : t) + "</span>";
      }).join("");
    };
    const sum = () => {
      const setv = (id, v) => { const el = $(id); el.textContent = v || "—"; el.classList.toggle("empty", !v); };
      setv("#sm-svc", state.svc);
      setv("#sm-day", state.day != null ? dayList[state.day].getDate() + " " + MO[dayList[state.day].getMonth()] + " (" + WD[dayList[state.day].getDay()] + ")" : "");
      setv("#sm-slot", state.slot);
    };
    $("#bk-services").addEventListener("click", (e) => {
      const c = e.target.closest("[data-svc]"); if (!c) return;
      state.svc = c.dataset.svc;
      $$("#bk-services .c").forEach((x) => x.classList.toggle("active", x === c)); sum();
    });
    $("#bk-days").addEventListener("click", (e) => {
      const d = e.target.closest("[data-day]"); if (!d) return;
      state.day = +d.dataset.day; state.slot = null;
      $$("#bk-days .d").forEach((x) => x.classList.toggle("active", x === d));
      renderSlots(); sum();
    });
    $("#bk-slots").addEventListener("click", (e) => {
      const s = e.target.closest("[data-slot]"); if (!s) return;
      state.slot = s.dataset.slot;
      $$("#bk-slots .slot").forEach((x) => x.classList.toggle("active", x === s)); sum();
    });
    renderSlots();
    // префилл услуги из калькулятора/радара
    $$('[data-book-to]').forEach((a) => a.addEventListener("click", () => {
      const want = a.dataset.bookTo;
      const c = $$('#bk-services .c').find((x) => x.dataset.svc === want);
      if (c) { state.svc = want; $$("#bk-services .c").forEach((x) => x.classList.toggle("active", x === c)); sum(); }
    }));

    const form = $("#bk-form");
    if (form) form.addEventListener("submit", (e) => {
      e.preventDefault();
      if (!state.svc || state.day == null || !state.slot) {
        const w = $("#bk-warn"); if (w) { w.style.display = "block"; }
        return;
      }
      $("#bk-form").style.display = "none";
      const ok = $("#bk-ok");
      if (ok) { ok.style.display = "block";
        $("#bk-ok-text").textContent = state.svc + " · " + dayList[state.day].getDate() + " " + MO[dayList[state.day].getMonth()] + " в " + state.slot;
      }
    });
  }
})();

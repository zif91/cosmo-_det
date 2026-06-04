# -*- coding: utf-8 -*-
"""Генератор кластерных SEO-страниц для Космос Детейлинг.
Единые шапка/подвал/форма, разный контент по кластерам."""
from string import Template

ARROW = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>'
CHK = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>'
PLUS = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M12 5v14M5 12h14"/></svg>'
ZOOM = '<span class="zoom"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="16" height="16"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4M11 8v6M8 11h6"/></svg></span>'
WA_PATH = '<path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2zm5.8 14.01c-.24.68-1.42 1.31-1.96 1.36-.5.05-.99.22-2.43-.51-2.43-1.21-3.98-3.83-4.1-4-.12-.17-.99-1.32-.99-2.51s.62-1.78.84-2.02c.22-.24.48-.3.64-.3l.46.01c.15 0 .35-.06.54.41.2.49.68 1.68.74 1.8.06.12.1.26.02.43-.08.17-.12.27-.24.42l-.36.42c-.12.12-.24.25-.1.49.14.24.62 1.02 1.33 1.65.91.81 1.68 1.06 1.92 1.18.24.12.38.1.52-.06.14-.17.6-.7.76-.94.16-.24.32-.2.54-.12.22.08 1.4.66 1.64.78.24.12.4.18.46.28.06.1.06.58-.18 1.26z"/>'
TG_PATH = '<path d="M21.94 4.5L18.6 20c-.25 1.1-.92 1.37-1.86.85l-5.14-3.79-2.48 2.39c-.27.27-.5.5-1.03.5l.37-5.23L17.1 6.1c.42-.37-.09-.58-.65-.21L6.16 12.5l-5.06-1.58c-1.1-.34-1.12-1.1.23-1.63l19.78-7.62c.92-.34 1.72.22 1.43 1.61z"/>'

HEADER = '''<header class="site-header">
  <div class="wrap bar">
    <a href="index.html" class="brand" aria-label="Космос Детейлинг — на главную">
      <span class="mark"><svg viewBox="0 0 44 44" fill="none"><circle cx="22" cy="22" r="7.5" fill="#e6cf9a"/><ellipse cx="22" cy="22" rx="19" ry="8" stroke="#e6cf9a" stroke-width="1.4" transform="rotate(-26 22 22)" opacity=".85"/><ellipse cx="22" cy="22" rx="19" ry="8" stroke="#7fb0ff" stroke-width="1" transform="rotate(34 22 22)" opacity=".4"/><circle cx="39" cy="13" r="2" fill="#f3e2b6"/></svg></span>
      <span class="txt"><b>КОСМОС</b><span>detailing studio</span></span>
    </a>
    <nav class="nav">
      <a href="index.html">Главная</a>
      <a href="zashchita-kuzova.html">Защита кузова</a>
      <a href="polirovka-keramika.html">Полировка</a>
      <a href="tonirovka-optika.html">Тонировка</a>
      <a href="detailing-salona.html">Салон</a>
      <a href="komfort.html">Комфорт</a>
      <a href="kontakty.html">Контакты</a>
    </nav>
    <div class="header-cta">
      <a href="tel:+79310000000" class="header-phone">+7 (931) 000-00-00</a>
      <a href="#zayavka" class="btn btn-primary">Рассчитать</a>
    </div>
    <button class="burger" aria-label="Меню"><span></span><span></span><span></span></button>
  </div>
</header>
<div class="mobile-menu">
  <a href="index.html">Главная <span class="muted">01</span></a>
  <a href="zashchita-kuzova.html">Защита кузова <span class="muted">02</span></a>
  <a href="polirovka-keramika.html">Полировка и керамика <span class="muted">03</span></a>
  <a href="tonirovka-optika.html">Тонировка и оптика <span class="muted">04</span></a>
  <a href="detailing-salona.html">Детейлинг салона <span class="muted">05</span></a>
  <a href="komfort.html">Комфорт и оборудование <span class="muted">06</span></a>
  <a href="kontakty.html">Контакты <span class="muted">07</span></a>
  <div class="mm-foot">
    <a href="tel:+79310000000" class="btn btn-ghost">+7 (931) 000-00-00</a>
    <a href="#zayavka" class="btn btn-primary">Рассчитать стоимость</a>
  </div>
</div>'''

def form_section():
    return '''<section class="section" id="zayavka">
  <div class="wrap">
    <div class="split">
      <div data-reveal>
        <span class="eyebrow">Заявка за минуту</span>
        <h2 class="h-xl" style="margin-top:16px">Рассчитаем стоимость и&nbsp;запишем на удобное&nbsp;время</h2>
        <p class="lead" style="margin-top:18px">Оставьте контакты — перезвоним, бесплатно осмотрим авто и зафиксируем смету. Или сразу напишите нам в мессенджер.</p>
        <ul class="check-list">
          <li>''' + CHK + '''<span><b>Бесплатный осмотр</b> и честная смета до работ</span></li>
          <li>''' + CHK + '''<span><b>Удобная запись</b> рядом с домом на Васильевском</span></li>
          <li>''' + CHK + '''<span><b>Отчёт</b> о каждом этапе в WhatsApp или Telegram</span></li>
        </ul>
        <div class="hero-cta" style="margin-top:30px">
          <a href="https://wa.me/79310000000" class="btn btn-wa" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor">''' + WA_PATH + '''</svg>WhatsApp</a>
          <a href="https://t.me/kosmos_detail" class="btn btn-ghost" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor">''' + TG_PATH + '''</svg>Telegram</a>
        </div>
      </div>
      <div class="lead-form" data-reveal data-d="1">
        <form data-lead>
          <div class="field"><label>Что интересует?</label>
            <div class="chips" data-multi="true"><span class="chip">Оклейка / PPF</span><span class="chip">Полировка</span><span class="chip">Керамика</span><span class="chip">Тонировка</span><span class="chip">Химчистка</span><span class="chip">Предпродажная</span></div>
          </div>
          <div class="field"><label for="nm">Ваше имя</label><input id="nm" type="text" placeholder="Как к вам обращаться" required></div>
          <div class="field"><label for="ph">Телефон</label><input id="ph" type="tel" placeholder="+7 (___) ___-__-__" required></div>
          <div class="field"><label for="car">Автомобиль (необязательно)</label><input id="car" type="text" placeholder="Марка, модель, год"></div>
          <button type="submit" class="btn btn-primary btn-block btn-lg">Получить расчёт</button>
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
</section>'''

FOOTER = '''<footer class="site-footer">
  <div class="wrap">
    <div class="foot-grid">
      <div class="foot-about">
        <a href="index.html" class="brand"><span class="mark"><svg viewBox="0 0 44 44" fill="none"><circle cx="22" cy="22" r="7.5" fill="#e6cf9a"/><ellipse cx="22" cy="22" rx="19" ry="8" stroke="#e6cf9a" stroke-width="1.4" transform="rotate(-26 22 22)" opacity=".85"/><circle cx="39" cy="13" r="2" fill="#f3e2b6"/></svg></span><span class="txt"><b>КОСМОС</b><span>detailing studio</span></span></a>
        <p>Премиальный детейлинг на Васильевском острове. Фиксированная смета, фото/видео-отчёт и гарантия результата.</p>
        <div class="socials">
          <a href="https://wa.me/79310000000" aria-label="WhatsApp" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2z"/></svg></a>
          <a href="https://t.me/kosmos_detail" aria-label="Telegram" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">''' + TG_PATH + '''</svg></a>
          <a href="#" aria-label="ВКонтакте"><svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M13.16 18.1c-7.3 0-11.46-5-11.64-13.3h3.66c.12 6.1 2.8 8.68 4.93 9.2V4.8h3.45v5.28c2.1-.22 4.3-2.6 5.04-5.28h3.45c-.57 3.3-2.95 5.68-4.64 6.66 1.69.8 4.4 2.87 5.43 6.64h-3.8c-.8-2.5-2.82-4.43-5.48-4.7v4.7h-.41z"/></svg></a>
        </div>
      </div>
      <div><h4>Услуги</h4><ul>
        <li><a href="zashchita-kuzova.html">Защита кузова · PPF</a></li>
        <li><a href="polirovka-keramika.html">Полировка и керамика</a></li>
        <li><a href="tonirovka-optika.html">Тонировка и оптика</a></li>
        <li><a href="detailing-salona.html">Детейлинг салона</a></li>
        <li><a href="komfort.html">Комфорт и оборудование</a></li>
      </ul></div>
      <div><h4>Студия</h4><ul>
        <li><a href="index.html#o-studii">О студии</a></li>
        <li><a href="index.html#pakety">Пакеты</a></li>
        <li><a href="index.html#raboty">Наши работы</a></li>
        <li><a href="index.html#faq">Вопросы и ответы</a></li>
        <li><a href="kontakty.html">Контакты</a></li>
      </ul></div>
      <div class="foot-contacts"><h4>Контакты</h4>
        <div class="c"><span>Адрес</span><b>СПб, ул. Кораблестроителей, 14</b></div>
        <div class="c"><span>Телефон</span><b><a href="tel:+79310000000">+7 (931) 000-00-00</a></b></div>
        <div class="c"><span>Почта</span><b><a href="mailto:info@kosmos-detail.ru">info@kosmos-detail.ru</a></b></div>
        <div class="c"><span>Режим работы</span><b>Ежедневно 10:00 – 22:00</b></div>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© <span data-year>2026</span> Космос Детейлинг Студия · Санкт-Петербург</span>
      <span>kosmos-detail.ru · <a href="#">Политика конфиденциальности</a></span>
    </div>
  </div>
</footer>
<a href="https://wa.me/79310000000" class="float-wa" aria-label="Написать в WhatsApp" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor">''' + WA_PATH + '''</svg></a>
<script src="assets/js/main.js"></script>
</body>
</html>'''

TEMPLATE = Template('''<!DOCTYPE html>
<html lang="ru">
<head>
<script>document.documentElement.classList.add('js');setTimeout(function(){if(!window.__kosmosReady){document.querySelectorAll('[data-reveal]').forEach(function(e){e.classList.add('in')})}},2000)</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>$title</title>
<meta name="description" content="$desc">
<meta name="keywords" content="$keywords">
<link rel="canonical" href="https://kosmos-detail.ru/$file">
<meta property="og:type" content="website">
<meta property="og:title" content="$ogtitle">
<meta property="og:description" content="$desc">
<meta property="og:url" content="https://kosmos-detail.ru/$file">
<meta property="og:image" content="https://kosmos-detail.ru/assets/img/$hero">
<meta property="og:locale" content="ru_RU">
<meta name="theme-color" content="#05060b">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='6' fill='%23e6cf9a'/%3E%3Cellipse cx='16' cy='16' rx='14' ry='6' fill='none' stroke='%23e6cf9a' stroke-width='1.4' transform='rotate(-28 16 16)'/%3E%3Ccircle cx='28' cy='9' r='1.8' fill='%23f3e2b6'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
{"@type":"ListItem","position":1,"name":"Главная","item":"https://kosmos-detail.ru/"},
{"@type":"ListItem","position":2,"name":"$crumb","item":"https://kosmos-detail.ru/$file"}]}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"Service","serviceType":"$crumb","areaServed":"Санкт-Петербург, Василеостровский район",
"provider":{"@type":"AutoRepair","name":"Космос Детейлинг Студия","telephone":"+7-931-000-00-00",
"address":{"@type":"PostalAddress","streetAddress":"ул. Кораблестроителей, 14","addressLocality":"Санкт-Петербург","postalCode":"199397","addressCountry":"RU"},
"geo":{"@type":"GeoCoordinates","latitude":59.9690,"longitude":30.2090}}}
</script>
</head>
<body>
<canvas id="stars"></canvas>
<div class="grain" aria-hidden="true"></div>
$header
<main>
<section class="page-hero">
  <div class="ph-media"><img src="assets/img/$hero" alt="$h1"></div>
  <div class="wrap">
    <nav class="breadcrumbs" data-reveal><a href="index.html">Главная</a><span class="sep">/</span><span>$crumb</span></nav>
    <span class="eyebrow" data-reveal>$eyebrow</span>
    <h1 class="h-xl" data-reveal data-d="1" style="margin-top:18px">$h1</h1>
    <p class="lead" data-reveal data-d="2">$lead</p>
    <div class="hero-cta" data-reveal data-d="3">
      <a href="#zayavka" class="btn btn-primary btn-lg">Рассчитать стоимость $arrow</a>
      <a href="https://wa.me/79310000000" class="btn btn-ghost btn-lg" target="_blank" rel="noopener">Задать вопрос</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap split">
    <div data-reveal>
      <span class="eyebrow">$introtag</span>
      <h2 class="h-lg" style="margin-top:16px">$introheading</h2>
      <p class="lead" style="margin-top:18px">$introtext</p>
      <ul class="check-list">$checks</ul>
    </div>
    <div class="split-media" data-reveal data-d="1"><span class="tag">$crumb</span><img src="assets/img/$introimg" alt="$introheading"></div>
  </div>
</section>

<section class="section section-tight">
  <div class="wrap">
    <div class="section-head" data-reveal><span class="eyebrow">Услуги и цены</span><h2 class="h-xl">$priceheading</h2><p>Стоимость зависит от класса, состояния авто и материалов. Точную цену фиксируем в смете после бесплатного осмотра.</p></div>
    <div class="price-table" data-reveal>$pricerows</div>
    <p class="form-note" style="margin-top:18px">* Цены ориентировочные. Итоговая стоимость — в фиксированной смете до начала работ.</p>
  </div>
</section>

<section class="section section-tight">
  <div class="wrap">
    <div class="section-head" data-reveal><span class="eyebrow">Наши работы</span><h2 class="h-xl">Примеры по направлению</h2><p>Реальные автомобили из наших боксов. Нажмите для увеличения.</p></div>
    <div class="gallery" data-reveal>$gallery</div>
  </div>
</section>

<section class="section section-tight">
  <div class="wrap">
    <div class="section-head center" data-reveal><span class="eyebrow center">Почему Космос</span><h2 class="h-xl">$whyheading</h2></div>
    <div class="grid grid-4">$features</div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="section-head center" data-reveal><span class="eyebrow center">Вопросы и ответы</span><h2 class="h-xl">Частые вопросы</h2></div>
    <div class="faq" data-reveal>$faq</div>
  </div>
</section>

<section class="section-tight">
  <div class="wrap">
    <div class="cta-band" data-reveal><div class="inner">
      <div><span class="eyebrow">Другие направления</span><h2 class="h-lg" style="margin-top:12px">Нужен комплексный уход?</h2><p class="muted" style="margin-top:10px;max-width:46ch">Соберём пакет под ваш автомобиль — от защиты кузова до детейлинга салона.</p></div>
      <div class="actions">$related</div>
    </div></div>
  </div>
</section>

$form
</main>
$footer''')

def rows(items):
    out = []
    for nm, desc, pr in items:
        out.append('<div class="pt-row"><div class="nm"><b>%s</b><span>%s</span></div><div class="pr">%s</div></div>' % (nm, desc, pr))
    return "\n".join(out)

def gal(items):
    out = []
    for n, tag, cap in items:
        out.append('<div class="shot"><img src="assets/img/thumb/work-%s.jpg" data-full="assets/img/work-%s.jpg" alt="%s — Космос Детейлинг" loading="lazy"><div class="cap"><span>%s</span>%s</div>%s</div>' % (n, n, cap, tag, cap, ZOOM))
    return "\n".join(out)

def checks(items):
    return "".join('<li>%s<span>%s</span></li>' % (CHK, c) for c in items)

def feats(items):
    out = []
    for ic, h, p in items:
        out.append('<div class="feat" data-reveal><div class="ic">%s</div><h3>%s</h3><p>%s</p></div>' % (ic, h, p))
    return "\n".join(out)

def faqs(items):
    out = []
    for q, a in items:
        out.append('<div class="qa"><button>%s<span class="ico">%s</span></button><div class="ans"><p>%s</p></div></div>' % (q, PLUS, a))
    return "\n".join(out)

def related(links):
    return "".join('<a href="%s" class="btn %s">%s</a>' % (h, c, t) for h, c, t in links)

# иконки для фич
IC_SHIELD='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'
IC_DOC='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M9 13h6M9 17h4"/></svg>'
IC_CAM='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>'
IC_STAR='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2l2.9 6.3L22 9.3l-5 4.8 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.8 7.1-1z"/></svg>'
IC_CLOCK='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>'
IC_SPARK='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l2.5 2.5M15.5 15.5L18 18M18 6l-2.5 2.5M8.5 15.5L6 18"/></svg>'
IC_GEAR='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M19 12a7 7 0 00-.1-1l2-1.6-2-3.4-2.4 1a7 7 0 00-1.7-1l-.3-2.5h-4l-.3 2.5a7 7 0 00-1.7 1l-2.4-1-2 3.4 2 1.6a7 7 0 000 2l-2 1.6 2 3.4 2.4-1a7 7 0 001.7 1l.3 2.5h4l.3-2.5a7 7 0 001.7-1l2.4 1 2-3.4-2-1.6a7 7 0 00.1-1z"/></svg>'

PAGES = {
"zashchita-kuzova.html": dict(
  title="Оклейка авто плёнкой в СПб — PPF, винил, антихром | Космос Детейлинг",
  desc="Бронирование кузова полиуретаном PPF, цветной и матовый винил, оклейка передней части, антихром, оклейка мото и брендирование. Васильевский остров, фиксированная смета и гарантия.",
  keywords="оклейка авто плёнкой спб, ppf, бронирование авто, виниловая плёнка, антихром, оклейка передней части, оклейка мотоцикла",
  ogtitle="Защита кузова — PPF, винил, антихром | Космос Детейлинг",
  crumb="Защита кузова", eyebrow="PPF · винил · антихром · мото",
  hero="work-049.jpg", introimg="work-037.jpg",
  h1="Защита кузова: плёнка PPF, винил и&nbsp;антихром",
  lead="Бронируем кузов антигравийным полиуретаном, меняем цвет матовым и глянцевым винилом, затемняем хром. Сохраняем заводское ЛКП и стоимость автомобиля.",
  introtag="Зачем это нужно", introheading="Защита, которую видно только в&nbsp;деталях",
  introtext="Полиуретановая плёнка PPF принимает на себя сколы от щебня, реагенты и мелкие царапины, а винил позволяет полностью изменить внешний вид без перекраса. Работаем в чистом боксе с лекалами под конкретную модель.",
  checks=["<b>Антигравийная защита</b> от сколов, песка и реагентов","<b>Самовосстановление</b> микроцарапин на полиуретане","<b>Смена цвета</b> винилом без потери гарантии на ЛКП","<b>Сохранение стоимости</b> авто при продаже"],
  priceheading="Оклейка и защита кузова",
  prices=[
    ("Локальная защита PPF","Капот, фары, пороги, ручки, зоны риска","от 12 000 ₽"),
    ("Бронирование передней части","Бампер, капот, крылья, зеркала, фары","от 70 000 ₽"),
    ("Полная оклейка кузова PPF","Максимальная защита всего ЛКП","от 200 000 ₽"),
    ("Оклейка винилом","Смена цвета: мат, глянец, металлик, сатин","от 60 000 ₽"),
    ("Антихром","Затемнение хромированных элементов","от 8 000 ₽"),
    ("Оклейка мотоцикла","Защита и стайлинг мото","от 25 000 ₽"),
    ("Рекламное брендирование","Коммерческий транспорт, фуры, фургоны","по проекту"),
  ],
  gallery=[("049","Винил","BMW X6 · матовая плёнка"),("058","Винил","Audi A5 · matte green"),("085","Винил","SUV · matte grey"),("037","PPF","Бронирование капота"),("043","Винил","Audi A6 · процесс оклейки"),("004","Винил","Audi Q5 · хамелеон"),("099","Винил","Audi Q5 · детали"),("028","Коммерция","Оклейка фургона"),("055","Коммерция","Брендирование тягача")],
  whyheading="Аккуратно, по лекалам, с&nbsp;гарантией",
  features=[(IC_SHIELD,"Плёнки премиум","Работаем с проверенными брендами полиуретана и винила"),(IC_GEAR,"Лекала под модель","Точный крой без лишних швов и подрезов на кузове"),(IC_CAM,"Отчёт по этапам","Показываем подготовку и процесс оклейки в мессенджере"),(IC_DOC,"Гарантия","Договор и гарантия на материал и работу")],
  faq=[
    ("Влияет ли плёнка PPF на радары и датчики?","Нет. Качественный полиуретан прозрачен для штатных радаров, камер и парктроников. Зоны датчиков обрабатываем аккуратно."),
    ("Чем полиуретан отличается от винила?","Полиуретан (PPF) — прозрачная защита от сколов и царапин с эффектом самовосстановления. Винил — это смена цвета и фактуры (мат, глянец, металлик). Часто их комбинируют."),
    ("Сколько служит плёнка?","Качественный полиуретан служит 5–10 лет, винил — 3–7 лет в зависимости от условий эксплуатации и ухода."),
    ("Можно ли мыть авто после оклейки?","Да. Первые дни даём плёнке стабилизироваться, далее — обычный уход. Рекомендуем бесконтактную мойку."),
  ],
  related=[("polirovka-keramika.html","btn btn-ghost","Полировка и керамика"),("kontakty.html","btn btn-primary","Записаться")],
),

"polirovka-keramika.html": dict(
  title="Полировка кузова и керамика в СПб | Космос Детейлинг на В.О.",
  desc="Глубокая восстановительная полировка, керамическое покрытие и жидкое стекло, антидождь, покраска дисков. Васильевский остров, фиксированная смета, гарантия на керамику.",
  keywords="полировка авто спб, керамика авто, нанокерамика, жидкое стекло, глубокая полировка, антидождь, покраска дисков",
  ogtitle="Полировка и керамика | Космос Детейлинг",
  crumb="Полировка и керамика", eyebrow="Полировка · керамика · защита блеска",
  hero="work-093.jpg", introimg="work-097.jpg",
  h1="Полировка кузова и&nbsp;керамическое покрытие",
  lead="Убираем голограммы, царапины и затёртости, возвращаем глубину цвета и защищаем результат керамикой. Зеркальный блеск, который держится сезонами.",
  introtag="Глубина и защита", introheading="Зеркальный блеск и&nbsp;твёрдая защита ЛКП",
  introtext="Восстановительная полировка устраняет дефекты лака, а керамика в несколько слоёв создаёт прочный гидрофобный барьер: грязь меньше липнет, мыть проще, цвет глубже. Подберём состав под бюджет и состояние авто.",
  checks=["<b>Глубина и зеркальность</b> цвета после полировки","<b>Защита от царапин</b> и дорожных реагентов","<b>Гидрофоб</b> — грязь и вода скатываются","<b>Гарантия на керамику</b> до 12 месяцев"],
  priceheading="Полировка, керамика и защита",
  prices=[
    ("Лёгкая защитная полировка","Освежить блеск, убрать лёгкий налёт","от 6 000 ₽"),
    ("Глубокая восстановительная полировка","Устранение голограмм, царапин, затёртостей","от 12 000 ₽"),
    ("Жидкое стекло","Бюджетная защита блеска на 3–6 мес.","от 8 000 ₽"),
    ("Керамика 2 слоя","Прочное гидрофобное покрытие","от 18 000 ₽"),
    ("Керамика премиум (многослойная)","Максимальная защита и глубина цвета","от 30 000 ₽"),
    ("Антидождь","Водоотталкивающее покрытие стекла","от 1 500 ₽"),
    ("Покраска дисков","Комплект, смена цвета дисков","от 16 000 ₽"),
  ],
  gallery=[("093","Керамика","BMW X5 · глубокий блеск"),("097","Керамика","Чёрный глянец"),("088","Керамика","BMW X5 · отражения"),("091","Полировка","SUV · подготовка"),("085","Защита","SUV · matte"),("058","Защита","Audi A5")],
  whyheading="Технология, а не&nbsp;«натёрли воском»",
  features=[(IC_SPARK,"Замер толщины ЛКП","Полируем безопасно, контролируя слой лака"),(IC_STAR,"Премиальные составы","Профессиональная керамика проверенных брендов"),(IC_CAM,"Фото до/после","Видно реальный результат полировки"),(IC_CLOCK,"Гарантия и уход","Гарантийный талон и рекомендации по мойке")],
  faq=[
    ("Сколько держится керамика?","Керамика 2 слоя — около 12 месяцев, премиум-многослойная — до 1–3 лет при правильном уходе и бесконтактной мойке."),
    ("Нужна ли полировка перед керамикой?","Да, для лучшего результата. Керамика подчёркивает состояние ЛКП, поэтому сначала убираем дефекты полировкой, затем наносим покрытие."),
    ("Чем керамика лучше жидкого стекла?","Жидкое стекло — базовая защита на 3–6 месяцев. Керамика твёрже, держится дольше и даёт более выраженный гидрофоб и глубину цвета."),
    ("Можно ли мыть авто на обычной мойке?","Можно, но мы рекомендуем бесконтактную мойку без агрессивной химии — так покрытие служит дольше."),
  ],
  related=[("zashchita-kuzova.html","btn btn-ghost","Защита кузова PPF"),("kontakty.html","btn btn-primary","Записаться")],
),

"tonirovka-optika.html": dict(
  title="Тонировка авто и защита оптики в СПб | Космос Детейлинг",
  desc="Тонировка стёкол по ГОСТ и атермальная, бронирование и шлифовка фар, защита лобового стекла плёнкой. Васильевский остров, аккуратно и с гарантией.",
  keywords="тонировка авто спб, атермальная тонировка, тонировка по гост, бронирование фар, шлифовка фар, защита лобового стекла",
  ogtitle="Тонировка и защита оптики | Космос Детейлинг",
  crumb="Тонировка и оптика", eyebrow="Тонировка · фары · лобовое",
  hero="work-097.jpg", introimg="work-025.jpg",
  h1="Тонировка авто и&nbsp;защита оптики",
  lead="Тонируем стёкла плёнкой премиум-класса, бронируем и полируем фары, защищаем лобовое от сколов. Комфорт, приватность и аккуратная работа без пузырей.",
  introtag="Комфорт и защита", introheading="Меньше солнца, бликов и&nbsp;любопытных глаз",
  introtext="Атермальная плёнка снижает нагрев салона и защищает от ультрафиолета, тонировка задней полусферы добавляет приватности, а бронирование фар и лобового спасает оптику и стекло от пескоструя и сколов.",
  checks=["<b>Приватность</b> и защита салона от выгорания","<b>Атермалка</b> — меньше жары и нагрева летом","<b>Защита оптики</b> от камней и пескоструя","<b>Аккуратный монтаж</b> без пузырей и отслоений"],
  priceheading="Тонировка и защита стекла",
  prices=[
    ("Тонировка задней полусферы","Задние боковые и стекло","от 4 000 ₽"),
    ("Тонировка по ГОСТ (перед)","Допустимая светопропускаемость","от 3 000 ₽"),
    ("Атермальная тонировка лобового","Защита от жары и UV без затемнения","от 6 000 ₽"),
    ("Бронирование фар плёнкой","Защита оптики от сколов","от 4 000 ₽"),
    ("Шлифовка и полировка фар","Возврат прозрачности помутневшим фарам","от 3 000 ₽"),
    ("Защита лобового стекла плёнкой","Антивандальная/антигравийная плёнка","от 12 000 ₽"),
  ],
  gallery=[("097","Оптика","Тёмные стёкла · SUV"),("025","Салон","Тонировка · комфорт"),("091","Оптика","SUV · стёкла"),("088","Оптика","BMW X5"),("085","Оптика","SUV matte")],
  whyheading="Чисто, ровно и&nbsp;по закону",
  features=[(IC_STAR,"Плёнки премиум","Стабильный цвет, не выгорает и не пузырится"),(IC_SHIELD,"По ГОСТ","Подскажем допустимую тонировку передних стёкол"),(IC_SPARK,"Атермальные решения","Комфорт в салоне летом без сильного затемнения"),(IC_DOC,"Гарантия","Гарантия на плёнку и качество монтажа")],
  faq=[
    ("Какая тонировка разрешена по ГОСТ?","Лобовое и передние боковые стёкла должны пропускать достаточно света по нормативам. Заднюю полусферу можно тонировать в любой плотности. Подберём допустимый вариант."),
    ("Что даёт атермальная плёнка?","Она снижает нагрев салона и отсекает ультрафиолет, при этом почти не затемняет стекло — комфорт летом и защита приборной панели."),
    ("Надолго ли бронирование фар?","Качественная плёнка служит несколько лет, защищая оптику от сколов и помутнения. При повреждении меняется только плёнка, а не дорогая фара."),
    ("Можно ли вернуть прозрачность старым фарам?","Да, шлифовкой и полировкой убираем желтизну и матовость. Для долговечности результат можно закрепить защитной плёнкой."),
  ],
  related=[("detailing-salona.html","btn btn-ghost","Детейлинг салона"),("kontakty.html","btn btn-primary","Записаться")],
),

"detailing-salona.html": dict(
  title="Детейлинг и химчистка салона авто в СПб | Космос Детейлинг",
  desc="Глубокая химчистка салона, озонация, реставрация и перетяжка кожи, перешив потолка, интерьерный детейлинг. Васильевский остров. Гарантия сухого салона без запаха.",
  keywords="химчистка салона авто спб, детейлинг салона, перетяжка салона, реставрация кожи, перешив потолка, озонация, перетяжка руля",
  ogtitle="Детейлинг и химчистка салона | Космос Детейлинг",
  crumb="Детейлинг салона", eyebrow="Химчистка · кожа · потолок · перетяжка",
  hero="work-025.jpg", introimg="work-097.jpg",
  h1="Детейлинг и&nbsp;химчистка салона",
  lead="Глубоко чистим салон, убираем запахи озонацией, реставрируем и перетягиваем кожу, перешиваем потолок. Авто выдаём сухим и без запаха — по проверке.",
  introtag="Салон как новый", introheading="Чистота, запах нового и&nbsp;уход за&nbsp;кожей",
  introtext="Делаем полную химчистку с контролем влажности и принудительной сушкой, восстанавливаем потёртую кожу, перешиваем потолок и элементы интерьера. Используем составы, безопасные для кожи, пластика и текстиля.",
  checks=["<b>Гарантия сухого салона</b> — выдаём только после проверки","<b>Безопасная химия</b> для кожи, пластика и ткани","<b>Озонация</b> — устранение запахов, а не маскировка","<b>Реставрация кожи</b> и возврат заводского вида"],
  priceheading="Химчистка, кожа и перетяжка",
  prices=[
    ("Экспресс-химчистка","Быстрое освежение салона","от 5 000 ₽"),
    ("Детейлинг-химчистка (полная)","Глубокая чистка всех поверхностей","от 10 000 ₽"),
    ("Озонация","Устранение запахов и дезинфекция","от 2 000 ₽"),
    ("Чистка и реставрация кожи","Восстановление потёртостей и цвета","от 3 000 ₽"),
    ("Перетяжка руля кожей","Натуральная кожа, аккуратный шов","от 8 000 ₽"),
    ("Перешив потолка","Алькантара или ткань","от 15 000 ₽"),
    ("Перетяжка салона / элементов","Сиденья, карты дверей, торпедо","по проекту"),
  ],
  gallery=[("025","Салон","Audi A6 · интерьер"),("097","Премиум","Глянец и салон"),("088","Премиум","BMW X5"),("091","Премиум","SUV")],
  whyheading="Чистим технологично, а&nbsp;не «помыли тряпкой»",
  features=[(IC_SPARK,"Контроль влажности","Принудительная сушка — без сырости и плесени"),(IC_STAR,"Уход за кожей","Бережные составы и реставрация без блеска"),(IC_CAM,"Фото-отчёт","Показываем проблемные зоны до и после"),(IC_DOC,"Гарантия результата","Сухой салон и устранение запаха")],
  faq=[
    ("Сколько сохнет салон после химчистки?","Мы сушим салон принудительно и контролируем влажность. Авто выдаём уже сухим, обычно в тот же день — без сырости и запаха."),
    ("Уберёте ли запах животных или табака?","Да. Сочетаем глубокую химчистку с озонацией, которая устраняет источник запаха, а не маскирует его."),
    ("Можно ли восстановить потёртую кожу?","В большинстве случаев да — чистим, реставрируем и тонируем кожу. Сильные повреждения решаем перетяжкой элемента."),
    ("Сколько занимает перетяжка?","Зависит от объёма: руль — от нескольких часов, потолок и сиденья — от 1–2 дней. Сроки называем в смете."),
  ],
  related=[("tonirovka-optika.html","btn btn-ghost","Тонировка"),("kontakty.html","btn btn-primary","Записаться")],
),

"komfort.html": dict(
  title="Шумоизоляция, доводчики, сигнализация и предпродажная подготовка авто в СПб",
  desc="Шумоизоляция салона, установка доводчиков дверей и сигнализации, удаление вмятин без покраски (PDR), предпродажная подготовка. Васильевский остров, фиксированная смета.",
  keywords="шумоизоляция авто спб, доводчики дверей, установка сигнализации, удаление вмятин без покраски, pdr, предпродажная подготовка авто",
  ogtitle="Комфорт, оборудование и предпродажная подготовка | Космос Детейлинг",
  crumb="Комфорт и оборудование", eyebrow="Шумка · доводчики · сигнализация · PDR",
  hero="work-085.jpg", introimg="work-091.jpg",
  h1="Комфорт, оборудование и&nbsp;предпродажная подготовка",
  lead="Делаем салон тише, двери — мягче, авто — безопаснее и аккуратнее. Шумоизоляция, доводчики, сигнализация, выправление вмятин и предпродажный комплекс.",
  introtag="Тишина и комфорт", introheading="Премиальные ощущения от&nbsp;каждой поездки",
  introtext="Шумоизоляция снижает гул дороги и делает акустику чище, доводчики добавляют плавное закрытие дверей, а сигнализация с автозапуском — комфорт и безопасность. Выправляем вмятины без покраски и готовим авто к продаже.",
  checks=["<b>Тише в салоне</b> — меньше гул дороги и вибрации","<b>Мягкое закрытие</b> дверей с доводчиками","<b>Безопасность</b> — сигнализация и автозапуск","<b>Товарный вид</b> к продаже без перекраса"],
  priceheading="Оборудование и подготовка",
  prices=[
    ("Шумоизоляция","По зонам или комплексная","от 15 000 ₽"),
    ("Установка доводчиков дверей","Плавное автоматическое закрытие","от 12 000 ₽"),
    ("Сигнализация с автозапуском","Подбор и установка","от 10 000 ₽"),
    ("Удаление вмятин без покраски (PDR)","Выправление без повреждения ЛКП","от 2 500 ₽"),
    ("Предпродажная подготовка","Комплекс «товарного вида»","от 9 000 ₽"),
  ],
  gallery=[("085","Комфорт","SUV · подготовка"),("091","Комфорт","SUV · бокс"),("088","Подготовка","BMW X5"),("097","Подготовка","Глянец")],
  whyheading="Делаем как для&nbsp;себя",
  features=[(IC_GEAR,"Качественные материалы","Шумоизоляция и оборудование проверенных марок"),(IC_SHIELD,"Аккуратный монтаж","Сборка-разборка без сколов и царапин"),(IC_STAR,"Предпродажный комплекс","Полировка, химчистка, оптика — авто как новое"),(IC_DOC,"Честная смета","Цена и сроки зафиксированы заранее")],
  faq=[
    ("Стоит ли делать шумоизоляцию?","Если хочется тише и комфортнее — да. Даже частичная шумка по аркам и дверям заметно снижает гул дороги и улучшает звук музыки."),
    ("Доводчики ставятся на любой автомобиль?","Почти на любой современный — подберём комплект под вашу модель. Закрытие дверей становится плавным и бесшумным."),
    ("Реально ли убрать вмятину без покраски?","Да, технологией PDR выправляем вмятины без нарушения заводского ЛКП — при условии, что краска не повреждена."),
    ("Что входит в предпродажную подготовку?","Комплекс зависит от состояния: мойка, полировка, химчистка салона, чернение, подкапотное пространство, оптика. Цель — товарный вид и меньше поводов для торга."),
  ],
  related=[("polirovka-keramika.html","btn btn-ghost","Полировка и керамика"),("kontakty.html","btn btn-primary","Записаться")],
),
}

for fname, d in PAGES.items():
    html = TEMPLATE.substitute(
        file=fname, title=d["title"], desc=d["desc"], keywords=d["keywords"], ogtitle=d["ogtitle"],
        crumb=d["crumb"], eyebrow=d["eyebrow"], hero=d["hero"], introimg=d["introimg"],
        h1=d["h1"], lead=d["lead"], introtag=d["introtag"], introheading=d["introheading"],
        introtext=d["introtext"], checks=checks(d["checks"]), priceheading=d["priceheading"],
        pricerows=rows(d["prices"]), gallery=gal(d["gallery"]), whyheading=d["whyheading"],
        features=feats(d["features"]), faq=faqs(d["faq"]), related=related(d["related"]),
        arrow=ARROW, header=HEADER, footer=FOOTER, form=form_section(),
    )
    with open(fname, "w", encoding="utf-8") as f:
        f.write(html)
    print("written:", fname, len(html), "bytes")
print("DONE")

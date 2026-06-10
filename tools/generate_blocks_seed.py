#!/usr/bin/env python3
"""Генерирует cms/core/database/seeds/content/blocks.json из данных статического сайта.

Кластерные страницы берутся из структур данных build_pages.py,
главная/контакты/404 описаны прямо здесь (контент перенесён из index.html и kontakty.html).
"""
import json
import pathlib

ROOT = pathlib.Path(__file__).resolve().parent.parent
OUT = ROOT / "cms/core/database/seeds/content/blocks.json"

# --- данные кластерных страниц из build_pages.py (без секции генерации файлов) ---
source = (ROOT / "build_pages.py").read_text(encoding="utf-8")
cut = source.index("for fname, d in PAGES.items():")
namespace = {}
exec(compile(source[:cut], "build_pages_data", "exec"), namespace)
PAGES = namespace["PAGES"]

DOC_IDS = {
    "zashchita-kuzova.html": 2,
    "polirovka-keramika.html": 3,
    "tonirovka-optika.html": 4,
    "detailing-salona.html": 5,
    "komfort.html": 6,
}

LEAD_CHECKS = [
    {"text": "<b>Бесплатный осмотр</b> и честная смета до работ"},
    {"text": "<b>Удобная запись</b> рядом с домом на Васильевском"},
    {"text": "<b>Отчёт</b> о каждом этапе в WhatsApp или Telegram"},
]
LEAD_CHIPS = [{"text": t} for t in ["Оклейка / PPF", "Полировка", "Керамика", "Тонировка", "Химчистка", "Предпродажная"]]

def lead_form(heading, lead, checks=None):
    return ["lead_form", {
        "eyebrow": "Заявка за минуту",
        "heading": heading,
        "lead": lead,
        "checks": checks or LEAD_CHECKS,
        "chips": LEAD_CHIPS,
        "btn_text": "Получить расчёт",
        "show_messengers": "1",
    }]

blocks = {}

# ---------------- Кластерные страницы ----------------
for fname, d in PAGES.items():
    doc_id = DOC_IDS[fname]
    page = []
    page.append(["page_hero", {
        "image": f"assets/img/{d['hero']}",
        "eyebrow": d["eyebrow"],
        "heading": d["h1"],
        "lead": d["lead"],
        "btn1_text": "Рассчитать стоимость",
        "btn1_link": "#zayavka",
        "btn2_text": "Задать вопрос",
        "btn2_link": "",
    }])
    page.append(["intro_split", {
        "tag": d["introtag"],
        "heading": d["introheading"],
        "text": d["introtext"],
        "checks": [{"text": c} for c in d["checks"]],
        "image": f"assets/img/{d['introimg']}",
        "image_tag": d["crumb"],
    }])
    page.append(["price_table", {
        "eyebrow": "Услуги и цены",
        "heading": d["priceheading"],
        "text": "Стоимость зависит от класса, состояния авто и материалов. Точную цену фиксируем в смете после бесплатного осмотра.",
        "rows": [{"name": n, "descr": ds, "price": p} for n, ds, p in d["prices"]],
        "note": "* Цены ориентировочные. Итоговая стоимость — в фиксированной смете до начала работ.",
    }])
    page.append(["gallery", {
        "anchor": "",
        "eyebrow": "Наши работы",
        "heading": "Примеры по направлению",
        "text": "Реальные автомобили из наших боксов. Нажмите для увеличения.",
        "shots": [{
            "image": f"assets/img/work-{n}.jpg",
            "thumb": f"assets/img/thumb/work-{n}.jpg",
            "tag": tag,
            "caption": cap,
        } for n, tag, cap in d["gallery"]],
        "more_text": "",
        "more_link": "",
    }])
    page.append(["features", {
        "eyebrow": "Почему Космос",
        "heading": d["whyheading"],
        "items": [{"icon": ic, "title": h, "text": p} for ic, h, p in d["features"]],
    }])
    page.append(["faq", {
        "anchor": "",
        "eyebrow": "Вопросы и ответы",
        "heading": "Частые вопросы",
        "items": [{"question": q, "answer": a} for q, a in d["faq"]],
    }])
    page.append(["cta_band", {
        "eyebrow": "Другие направления",
        "heading": "Нужен комплексный уход?",
        "text": "Соберём пакет под ваш автомобиль — от защиты кузова до детейлинга салона.",
        "buttons": [
            {"text": t, "link": href, "style": "primary" if "primary" in cls else "ghost"}
            for href, cls, t in d["related"]
        ],
    }])
    page.append(lead_form(
        "Рассчитаем стоимость и&nbsp;запишем на удобное&nbsp;время",
        "Оставьте контакты — перезвоним, бесплатно осмотрим авто и зафиксируем смету. Или сразу напишите нам в мессенджер.",
    ))
    blocks[doc_id] = page

# ---------------- Главная (контент из index.html) ----------------
IC = {
    "check_doc": '<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>',
    "video": '<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>',
    "shield": '<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
    "clock": '<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',
}

blocks[1] = [
    ["hero_main", {
        "image": "assets/img/work-004.jpg",
        "image_alt": "Автомобиль после детейлинга в студии Космос на Васильевском острове",
        "eyebrow": "Санкт-Петербург · Васильевский остров · Кораблестроителей 14",
        "heading": 'Детейлинг<br>уровня <span class="shine">орбиты</span>',
        "lead": 'Технологичный детейлинг на Васильевском острове с <b class="gold">фиксированной сметой</b>, фото- и видео-контролем работ и гарантией результата. Отдельные чистые боксы — не поток автомойки.',
        "btn1_text": "Рассчитать смету",
        "btn1_link": "#calculator",
        "btn2_text": "Написать в WhatsApp",
        "btn2_link": "",
        "counters": [
            {"value": "99", "suffix": "+", "label": "работ в портфолио"},
            {"value": "100", "suffix": "%", "label": "работ с фотоотчётом"},
            {"value": "2", "suffix": "", "label": "изолированных бокса"},
            {"value": "10–22", "suffix": "", "label": "работаем ежедневно"},
        ],
    }],
    ["trust_strip", {
        "items": [
            {"icon": IC["check_doc"], "title": "Фиксированная смета", "text": "Цену согласуем до начала работ — без скрытых доплат «по факту»."},
            {"icon": IC["video"], "title": "Фото и видео-отчёт", "text": "Присылаем этапы работ в ваш мессенджер — вы видите процесс."},
            {"icon": IC["shield"], "title": "Договор и гарантия", "text": "Официальный акт приёмки и гарантия на ключевые услуги."},
            {"icon": IC["clock"], "title": "Чёткие сроки", "text": "Называем срок заранее и выдаём авто вовремя, по проверке."},
        ],
    }],
    ["compare", {
        "eyebrow": "Зачем студия, а не мойка",
        "heading": "Детейлинг — это не «мойка&nbsp;подороже»",
        "text": "Мы работаем в отдельных изолированных боксах с контролируемой чистотой. Премиальный автомобиль не стоит в общем потоке — это разные технологии, материалы и стандарты приёмки.",
        "bad_label": "Поточная мойка",
        "bad_title": "Конвейер и «по факту»",
        "bad_items": [
            {"text": "Цена меняется после приезда"},
            {"text": "Общий поток, спешка, риск повредить ЛКП"},
            {"text": "Нет отчёта и согласования допработ"},
            {"text": "Навязывание услуг на месте"},
        ],
        "good_label": "Космос Детейлинг",
        "good_title": "Прозрачный премиальный процесс",
        "good_items": [
            {"text": "Фиксированная смета до начала работ"},
            {"text": "Отдельные чистые боксы и сертифицированные мастера"},
            {"text": "Фото/видео каждого этапа в мессенджер"},
            {"text": "Договор, гарантия, сухой салон по проверке"},
        ],
    }],
    ["services_grid", {
        "eyebrow": "Направления студии",
        "heading": "Полный уход за&nbsp;автомобилем — от&nbsp;брони до&nbsp;салона",
        "text": "Шесть направлений и более 25 услуг. Выберите интересующее — внутри подробности, примеры работ и ориентир по цене.",
        "cards": [
            {"doc_id": "2", "anchor": "", "num": "01 / Защита", "image": "assets/img/thumb/work-049.jpg", "image_alt": "Оклейка авто плёнкой PPF и винил", "title": "Защита кузова", "text": "Антигравийный полиуретан PPF, цветной и матовый винил, оклейка передней части, антихром.", "tags": "PPF, Винил, Антихром, Мото"},
            {"doc_id": "3", "anchor": "", "num": "02 / Блеск", "image": "assets/img/thumb/work-093.jpg", "image_alt": "Полировка кузова и нанесение керамики", "title": "Полировка и керамика", "text": "Глубокая восстановительная полировка, керамическое покрытие, жидкое стекло, антидождь, покраска дисков.", "tags": "Полировка, Керамика, Антидождь"},
            {"doc_id": "4", "anchor": "", "num": "03 / Оптика", "image": "assets/img/thumb/work-097.jpg", "image_alt": "Тонировка стёкол и бронирование фар", "title": "Тонировка и оптика", "text": "Тонировка по ГОСТ и атермальная, бронирование и шлифовка фар, защита лобового стекла.", "tags": "Тонировка, Брони фар, Лобовое"},
            {"doc_id": "5", "anchor": "", "num": "04 / Салон", "image": "assets/img/thumb/work-025.jpg", "image_alt": "Химчистка и детейлинг салона авто", "title": "Детейлинг салона", "text": "Глубокая химчистка, реставрация и перетяжка кожи, перешив потолка, озонация, интерьерный детейлинг.", "tags": "Химчистка, Перетяжка, Кожа, Потолок"},
            {"doc_id": "6", "anchor": "", "num": "05 / Комфорт", "image": "assets/img/thumb/work-085.jpg", "image_alt": "Шумоизоляция, доводчики, сигнализация", "title": "Комфорт и оборудование", "text": "Шумоизоляция, доводчики дверей, сигнализация, выпрямление вмятин без покраски, предпродажная подготовка.", "tags": "Шумка, Доводчики, PDR"},
            {"doc_id": "6", "anchor": "#predprodazhnaya", "num": "06 / Продажа", "image": "assets/img/thumb/work-088.jpg", "image_alt": "Предпродажная подготовка автомобиля", "title": "Предпродажная подготовка", "text": "Комплекс «товарного вида»: полировка, химчистка, оптика, подкапотное пространство. Снижает поводы для торга.", "tags": "Комплекс, Товарный вид"},
        ],
    }],
    ["radar", {
        "eyebrow": "Интерактивный радар",
        "heading": "Карта уязвимостей&nbsp;вашего авто",
        "text": "Выберите зону кузова — покажем, что ей угрожает и как мы защищаем. Параметры «до / после» детейлинга.",
        "panel_tag": "Cosmos diagnostics · сканирование зон",
        "meta1_value": "98.8%", "meta1_label": "точность защиты",
        "meta2_value": "STEK / Krytex", "meta2_label": "сертиф. материалы",
        "image": "assets/img/work-088.jpg",
        "hotspots": [
            {"zone": "hood", "left": "22", "top": "62", "label": "Морда · оптика"},
            {"zone": "windshield", "left": "47", "top": "30", "label": "Лобовое"},
            {"zone": "interior", "left": "66", "top": "30", "label": "Салон"},
            {"zone": "sides", "left": "84", "top": "52", "label": "Борта · ЛКП"},
            {"zone": "wheels", "left": "73", "top": "78", "label": "Колёса"},
        ],
    }],
    ["calculator", {
        "eyebrow": "Бортовой калькулятор",
        "heading": "Рассчитайте смету&nbsp;за минуту",
        "text": "Прозрачный расчёт по классу авто и услугам — или ремонт сколов лобового по формуле ГОСТ. Точную смету фиксируем после осмотра.",
        "mode1_label": "Детейлинг и защита",
        "mode2_label": "Ремонт сколов · ГОСТ",
        "note": "* Ориентировочно. Точная смета — после бесплатного осмотра.",
    }],
    ["packages", {
        "eyebrow": "Готовые решения",
        "heading": "Пакеты вместо длинного прайса",
        "text": "Понятный выбор под задачу: от свежести салона до полной защиты. Точная стоимость фиксируется в смете после осмотра.",
        "items": [
            {"name": "Start", "price": "6 900", "featured": "", "badge": "",
             "for": "Освежить автомобиль: внешний вид и салон без сложных работ",
             "features": "Детейлинг-мойка в 2 фазы\nЭкспресс-уборка салона\nЧернение шин, защитный воск\nОбезжелезивание кузова",
             "btn_text": "Выбрать Start", "btn_link": "#zayavka"},
            {"name": "Optimal", "price": "18 900", "featured": "1", "badge": "Хит выбора",
             "for": "Глубокий уход и защита блеска на сезон вперёд",
             "features": "Всё из пакета Start\nВосстановительная полировка ЛКП\nКерамика 2 слоя\nХимчистка салона + озонация\nАнтидождь на лобовое",
             "btn_text": "Выбрать Optimal", "btn_link": "#zayavka"},
            {"name": "Pro", "price": "49 000", "featured": "", "badge": "",
             "for": "Максимальная защита премиального автомобиля",
             "features": "Всё из пакета Optimal\nОклейка зон риска плёнкой PPF\nМногослойная керамика премиум\nЗащита кожи и салона\nГарантийный талон",
             "btn_text": "Выбрать Pro", "btn_link": "#zayavka"},
        ],
        "note": "* Цены ориентировочные и зависят от класса и состояния авто. Точная стоимость — в фиксированной смете после бесплатного осмотра.",
    }],
    ["gallery", {
        "anchor": "raboty",
        "eyebrow": "Наши работы",
        "heading": "Реальное портфолио&nbsp;— без стоковых картинок",
        "text": "Только автомобили, прошедшие через наши боксы. Нажмите на снимок, чтобы рассмотреть детали.",
        "shots": [
            {"image": "assets/img/work-005.jpg", "thumb": "assets/img/thumb/work-005.jpg", "tag": "Винил", "caption": "Audi Q5 · матовый хамелеон"},
            {"image": "assets/img/work-049.jpg", "thumb": "assets/img/thumb/work-049.jpg", "tag": "Винил", "caption": "BMW X6 · матовая плёнка"},
            {"image": "assets/img/work-037.jpg", "thumb": "assets/img/thumb/work-037.jpg", "tag": "PPF", "caption": "Бронирование капота"},
            {"image": "assets/img/work-093.jpg", "thumb": "assets/img/thumb/work-093.jpg", "tag": "Керамика", "caption": "BMW X5 · глубокий блеск"},
            {"image": "assets/img/work-058.jpg", "thumb": "assets/img/thumb/work-058.jpg", "tag": "Винил", "caption": "Audi A5 · matte green"},
            {"image": "assets/img/work-025.jpg", "thumb": "assets/img/thumb/work-025.jpg", "tag": "Салон", "caption": "Audi A6 · интерьер"},
            {"image": "assets/img/work-085.jpg", "thumb": "assets/img/thumb/work-085.jpg", "tag": "Винил", "caption": "SUV · matte grey"},
            {"image": "assets/img/work-097.jpg", "thumb": "assets/img/thumb/work-097.jpg", "tag": "Керамика", "caption": "Глубокий чёрный глянец"},
            {"image": "assets/img/work-008.jpg", "thumb": "assets/img/thumb/work-008.jpg", "tag": "Винил", "caption": "Audi Q5 · детали"},
            {"image": "assets/img/work-043.jpg", "thumb": "assets/img/thumb/work-043.jpg", "tag": "Винил", "caption": "Audi A6 · процесс"},
            {"image": "assets/img/work-028.jpg", "thumb": "assets/img/thumb/work-028.jpg", "tag": "Коммерция", "caption": "Оклейка фургона"},
            {"image": "assets/img/work-055.jpg", "thumb": "assets/img/thumb/work-055.jpg", "tag": "Коммерция", "caption": "Брендирование тягача"},
        ],
        "more_text": "Смотреть больше работ и записаться",
        "more_link": "kontakty.html",
    }],
    ["process", {
        "eyebrow": "Как мы работаем",
        "heading": "Прозрачный путь автомобиля",
        "steps": [
            {"title": "Осмотр и смета", "text": "Бесплатно оцениваем состояние, фиксируем смету и сроки. Без доплат «по факту»."},
            {"title": "Приёмка по акту", "text": "Фотофиксация всех зон и спорных мест. Согласуем объём работ письменно."},
            {"title": "Работа с отчётом", "text": "Делаем в чистом боксе и присылаем этапы в мессенджер в реальном времени."},
            {"title": "Выдача и гарантия", "text": "Проверяем результат вместе с вами, выдаём гарантию и рекомендации по уходу."},
        ],
    }],
    ["stats", {
        "items": [
            {"value": "99", "suffix": "+", "label": "работ в портфолио"},
            {"value": "25", "suffix": "+", "label": "услуг детейлинга"},
            {"value": "100", "suffix": "%", "label": "работ с фотоотчётом"},
            {"value": "12", "suffix": " мес", "label": "гарантия на керамику"},
        ],
    }],
    ["china_split", {
        "eyebrow": "Новые премиум-бренды",
        "heading": "Знаем специфику китайских&nbsp;премиум-авто",
        "lead": "Zeekr, Li, Voyah, Tank и другие активно растут в премиальном сегменте. У них особая сборка и мягкое ЛКП — мы подбираем плёнку, полироль и керамику под конкретную модель.",
        "brands": [{"name": n} for n in ["Zeekr", "Li (Lixiang)", "Voyah", "Tank", "Avatr", "Exeed", "Hongqi"]],
        "btn_text": "Подобрать уход для авто",
        "btn_link": "#zayavka",
        "image": "assets/img/work-091.jpg",
        "image_alt": "Уход за современным премиальным внедорожником",
        "image_tag": "Премиум-сегмент",
    }],
    ["reviews", {
        "eyebrow": "Отзывы клиентов",
        "heading": "Нам доверяют дорогие автомобили",
        "text": "Реальные отзывы подключаются из карточек Яндекс&nbsp;Карт и 2ГИС. Ниже — примеры.",
        "items": [
            {"stars": "5", "name": "Дмитрий К.", "car": "Audi Q5 · керамика", "text": "Делал керамику на Q5 — прислали фото каждого этапа прямо в Telegram. Смету назвали сразу и не изменили. Блеск держится отлично."},
            {"stars": "5", "name": "Марина С.", "car": "BMW X6 · PPF + тонировка", "text": "Оклеили перед в полиуретан и затонировали. Аккуратно, в срок, бокс чистый — видно, что это студия, а не мойка при заправке. Рекомендую."},
            {"stars": "5", "name": "Алексей В.", "car": "Mercedes · предпродажная", "text": "Брал предпродажную подготовку. Машину было не узнать — продал быстро и без торга по мелочам. Спасибо за честный подход и отчёт."},
        ],
    }],
    ["faq", {
        "anchor": "faq",
        "eyebrow": "Вопросы и мифы",
        "heading": "Коротко о&nbsp;главном",
        "items": [
            {"question": "Влияет ли плёнка PPF на радары и датчики парковки?", "answer": "Нет. Качественный полиуретан прозрачен для штатных радаров, камер и парктроников. Мы используем плёнки проверенных брендов и аккуратно обрабатываем зоны датчиков."},
            {"question": "Чем керамика отличается от жидкого стекла?", "answer": "Жидкое стекло — это базовая защита на 3–6 месяцев. Профессиональная керамика в несколько слоёв даёт более твёрдое покрытие, глубину цвета и держится до 1–3 лет. Подберём вариант под бюджет и задачи."},
            {"question": "Сколько сохнет салон после химчистки?", "answer": "Мы сушим салон принудительно и контролируем влажность. Авто выдаём только после проверки — без сырости и запаха. Гарантируем сухой салон."},
            {"question": "Можно ли узнать цену заранее?", "answer": "Да. После осмотра мы фиксируем смету до начала работ. Любые дополнительные работы согласуем отдельно по фото — без неожиданных доплат."},
            {"question": "Где вы находитесь и как заехать?", "answer": "Санкт-Петербург, Васильевский остров, ул. Кораблестроителей, 14 — рядом с гостиницей Cosmos, удобный съезд с ЗСД. Подробности и карта на странице «Контакты»."},
        ],
    }],
    ["booking", {
        "eyebrow": "Онлайн-запись",
        "heading": "Запишитесь на&nbsp;удобное окошко",
        "text": "Выберите услугу, день и свободное время — мы подтвердим запись и заранее подготовим бокс.",
        "btn_text": "Записаться",
    }],
    lead_form(
        "Рассчитаем стоимость и&nbsp;запишем на удобное&nbsp;время",
        "Оставьте контакты — перезвоним, бесплатно осмотрим авто и зафиксируем смету. Или сразу напишите нам в мессенджер.",
    ),
]

# ---------------- Контакты ----------------
blocks[7] = [
    ["page_hero", {
        "image": "assets/img/work-005.jpg",
        "eyebrow": "Васильевский остров · Намыв",
        "heading": "Контакты и&nbsp;как нас найти",
        "lead": "Мы на Васильевском острове — рядом с гостиницей Cosmos, удобный съезд с ЗСД. Запишитесь по телефону, в мессенджере или через форму ниже.",
        "btn1_text": "", "btn1_link": "",
        "btn2_text": "", "btn2_link": "",
    }],
    ["contacts_info", {
        "checks": [
            {"text": "<b>На автомобиле:</b> удобный съезд с ЗСД, парковка у студии"},
            {"text": "<b>Ориентир:</b> рядом гостиница Cosmos / Прибалтийская"},
            {"text": "<b>Рядом метро</b> Приморская, районы Намыв и В.О."},
        ],
        "map_embed": "",
    }],
    lead_form(
        "Запишитесь на&nbsp;осмотр и&nbsp;расчёт",
        "Оставьте контакты — перезвоним, бесплатно осмотрим авто и зафиксируем смету. Работаем по записи, чтобы вам не ждать в очереди.",
        checks=[
            {"text": "<b>Бесплатный осмотр</b> и честная смета до работ"},
            {"text": "<b>Фото/видео-отчёт</b> о каждом этапе"},
            {"text": "<b>Гарантия</b> на ключевые услуги"},
        ],
    ),
]

# ---------------- 404 ----------------
blocks[9] = [
    ["page_hero", {
        "image": "assets/img/work-091.jpg",
        "eyebrow": "Ошибка 404",
        "heading": "Страница не&nbsp;найдена",
        "lead": "Такой страницы нет или она переехала. Вернитесь на главную или выберите направление в меню.",
        "btn1_text": "На главную", "btn1_link": "index.html",
        "btn2_text": "Контакты", "btn2_link": "kontakty.html",
    }],
]

OUT.write_text(json.dumps(blocks, ensure_ascii=False, indent=1), encoding="utf-8")
total = sum(len(v) for v in blocks.values())
print(f"written {OUT} · {len(blocks)} documents · {total} blocks")

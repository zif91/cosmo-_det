# Космос Детейлинг — сайт на Evolution CMS 3

Готовый к установке дистрибутив сайта: Evolution CMS 3 + PageBuilder + ClientSettings.
Все страницы — ресурсы CMS, все секции страниц — редактируемые блоки PageBuilder,
все контакты/тексты шапки и подвала — настройки ClientSettings. Вся структура БД
создаётся **Laravel-миграциями** (`php artisan migrate`).

## Установка одной командой

На чистом Ubuntu/Debian-сервере (от root):

```bash
git clone https://github.com/zif91/cosmo-_det.git /opt/cosmo-src
bash /opt/cosmo-src/deploy/install.sh
```

Скрипт ставит nginx + PHP-FPM + MariaDB, клонирует
[evocms-community/evolution](https://github.com/evocms-community/evolution),
выполняет CLI-установку CMS, копирует файлы
[PageBuilder](https://github.com/evocms-community/pagebuilder) и
[ClientSettings](https://github.com/evocms-community/clientsettings),
накатывает оверлей из `cms/` и запускает миграции. В конце выводит адрес
админки и сгенерированные пароли.

Параметры переопределяются окружением:

```bash
SITE_URL=https://kosmos-detail.ru ADMIN_PASSWORD=... DB_PASS=... bash deploy/install.sh
```

## Что внутри `cms/` (оверлей поверх корня Evolution)

```
views/                       Blade-шаблоны
  layouts/app.blade.php      базовый layout: SEO-мета, OG, JSON-LD, коды счётчиков
  partials/                  шапка, подвал, иконки, JSON-LD хлебных крошек/услуги
  blocks/                    вьюшки блоков PageBuilder (22 блока)
  main|cluster|contacts|service|sitemap.blade.php   шаблоны страниц
assets/plugins/pagebuilder/config/   конфиги контейнера и блоков (поля админки)
assets/modules/clientsettings/config/ вкладки настроек сайта (3 вкладки)
core/custom/
  composer.json              автозагрузка пакета EvolutionCMS\Main
  routes.php                 POST /api/lead — приём заявок с форм
  config/cms/settings.php    ControllerNamespace
  packages/main/src/
    Controllers/             Base/Main/Cluster/Contacts/Service/Sitemap
    Services/LeadService.php заявки: site_leads + e-mail + Telegram
core/database/
  migrations/                6 миграций (см. ниже)
  seeds/                     данные: ресурсы, настройки, блоки, код элементов
```

## Миграции

| Миграция | Что делает |
|---|---|
| `100000_create_pagebuilder_table` | таблица `pagebuilder` (блоки страниц) |
| `100010_create_site_leads_table` | таблица `site_leads` (заявки с форм) |
| `100020_install_pagebuilder_elements` | плагин + сниппет PageBuilder, события OnPB* |
| `100030_install_clientsettings_module` | модуль ClientSettings + плагин меню + события |
| `100040_create_site_structure` | шаблоны, SEO-ТВ, дерево ресурсов (9 шт.), системные настройки |
| `100050_seed_pagebuilder_content` | контент всех страниц блоками (59 блоков) |

Откат: `php artisan migrate:rollback` (миграции обратимы).

## Структура сайта (ресурсы)

1. Главная (`main`) · 2–6. Кластеры услуг (`cluster`):
зашита кузова / полировка / тонировка / салон / комфорт ·
7. Контакты (`contacts`) · 8. `sitemap.xml` (`sitemap`, text/xml) · 9. Страница 404 (`service`).

ЧПУ включены, суффикс `.html` — URL полностью совпадают со статической версией
(`/zashchita-kuzova.html` и т.д.), редизайн URL для SEO не требуется.

## SEO «из коробки»

- `pagetitle` / `longtitle` (title) / `description` — стандартные поля ресурса;
- ТВ на всех шаблонах: `seo_keywords`, `og_title`, `og_image`, `seo_robots`,
  `seo_canonical`, `sitemap_exclude`, `sitemap_changefreq`, `sitemap_priority`;
- `sitemap.xml` генерируется контроллером из дерева ресурсов с учётом ТВ;
- JSON-LD: AutoRepair (организация), BreadcrumbList + Service на кластерах;
- canonical, OG-теги, meta robots — в layout.

## Редактирование

- **Страницы и секции** — админка → ресурс → вкладка «Конструктор»:
  каждый блок (hero, прайс, галерея, FAQ, пакеты, отзывы …) с полями, порядок
  блоков меняется перетаскиванием, блоки можно скрывать/добавлять.
- **Контакты, телефоны, мессенджеры, карта, коды счётчиков** —
  админка → «Настройки сайта» (модуль ClientSettings, 3 вкладки).
- **Заявки** — таблица `site_leads`; уведомления на e-mail
  (`client_lead_email`) и в Telegram (`client_lead_telegram_token/chat`).

## Регенерация контент-сидов

Контент блоков собирается из статической версии сайта:

```bash
python3 tools/generate_blocks_seed.py   # обновит cms/core/database/seeds/content/blocks.json
```

## Примечания

- Данные интерактивных виджетов (радар зон, калькулятор, слоты онлайн-записи)
  живут в `assets/js/main.js` — заголовки/тексты секций редактируются блоками,
  цены калькулятора правятся в JS (объект `SERVICES`/`GOST` в начале файла).
- Перед запуском в прод замените телефоны-заглушки в «Настройках сайта»
  и подключите счётчики аналитики (поле «Коды в head»).

# remod — Бэкенд (Symfony)

## Установка проекта в Docker

1. Скопировать `.env` и заполнить credentials
```bash
$ cp .env.example .env
```

2. Собрать Docker
```bash
$ docker-compose build
```

3. Запустить Docker
```bash
$ docker-compose up -d
```

4. Зайти в контейнер
```bash
$ docker exec -it php_container bash
```

5. Внутри контейнера — установить зависимости и накатить миграции
```bash
$ composer install
$ php bin/console doctrine:migrations:migrate
```

6. Загрузить фикстуры (данные для старта)
```bash
$ php bin/console doctrine:fixtures:load
```

7. Создать администратора (изменить логин и пароль)
```bash
$ php bin/console app:create-admin admin_login admin_password
```

8. Выдать права на папки с загрузками
```bash
$ chown -R www-data:www-data public/uploads public/media \
    && chmod -R 775 public/uploads \
    && chmod -R 775 public/media
```

9. Очистить кэш
```bash
$ php bin/console cache:clear
```

10. Админ-панель доступна на `http://localhost:8080/admin`

11. Опционально — запустить DBGate для просмотра БД
```bash
docker compose -f docker-compose.dbgate.yml up -d
# остановить:
docker compose -f docker-compose.dbgate.yml down -v
```

---

## Архитектура

Nginx — единая точка входа. Все запросы идут через него.
Контейнеры объединены внутренней Docker-сетью `app-net`.

```
Браузер
  → Nginx
      ├── /api/*          → Symfony (REST API)
      ├── /*              → React (dist/ в prod, Vite в dev)
      ├── /admin/*        → Symfony (EasyAdmin) на :8080
      ├── /login, /logout → Symfony (авторизация) на :8080
      ├── /uploads/*      → статика с диска
      ├── /media/cache/*  → LiipImagine (ресайз картинок)
```

### Контейнеры

| Контейнер        | Сервис             | Сеть      | Порты                                      |
|------------------|--------------------|-----------|--------------------------------------------|
| `nginx_web`      | Nginx              | app-net   | 80 (prod), 3000 (dev), 8080 (symfony only) |
| `php_container`  | PHP-FPM + Symfony  | app-net   | —                                          |
| `postgres`       | PostgreSQL         | app-net   | 5432                                       |
| `react_app`      | Vite dev server    | app-net   | — (только в dev)                           |

### Порты

| Порт    | Режим | Что обслуживает                                        |
|---------|-------|--------------------------------------------------------|
| `:80`   | Prod  | React SPA из `dist/` + API                            |
| `:3000` | Dev   | Vite с HMR + API                                      |
| `:8080` | Any   | Symfony only: EasyAdmin + `/login`, `/logout`          |

---

## Dev-режим

**URL: `http://localhost:3000`**

```bash
# 1. Поднять бэкенд (создаёт сеть app-net)
cd symfony_remod
docker compose up -d

# 2. Поднять фронт (подключается к app-net)
cd react_remod
docker compose up -d
```

- Vite dev server работает с горячей перезагрузкой (HMR)
- Изменения в коде сразу отображаются в браузере
- API доступно на том же порту `:3000`, EasyAdmin — на `:8080`

## Prod-режим

**URL: `http://localhost`** (порт 80)

```bash
# 1. Поднять бэкенд
cd symfony_remod
docker compose up -d

# 2. Поднять фронт, собрать билд, потушить
cd react_remod
docker compose up -d
docker exec react_app npm run build
docker compose down
```

- Nginx отдаёт статику из `dist/`
- React-контейнер в проде не нужен
- Пересборка без удаления `dist/`: `docker exec react_app npm run build`

---

## API эндпоинты

| Метод  | URL                    | Описание                        |
|--------|------------------------|---------------------------------|
| GET    | `/api/cases`           | Список всех кейсов              |
| GET    | `/api/cases/{slug}`    | Один кейс с галереей            |
| GET    | `/api/testimonials`    | Отзывы клиентов                 |
| GET    | `/api/packages`        | Пакеты отделки                  |
| GET    | `/api/faqs`            | Часто задаваемые вопросы        |
| GET    | `/api/contacts`        | Контакты компании               |
| POST   | `/api/leads`           | Приём заявки с сайта            |

---

## EasyAdmin (Админ-панель)

URL: `http://localhost:8080/admin`

Разделы:
- **Кейсы** — управление кейсами ремонта (фото до/после, описание, сложности)
- **Галерея кейсов** — дополнительные фото к каждому кейсу
- **Отзывы** — отзывы клиентов
- **Пакеты отделки** — White Box, Белый, Серый
- **FAQ** — вопросы и ответы
- **Контакты** — телефон, мессенджеры, адрес, часы работы
- **Заявки** — заявки с сайта (только просмотр)

---

## Загрузка изображений (VichUploader)

Конфиг: `config/packages/vich_uploader.yaml`

| Маппинг         | Папка                          | Назначение               |
|-----------------|--------------------------------|--------------------------|
| `case_before`   | `public/uploads/cases/before`  | Фото ДО ремонта          |
| `case_after`    | `public/uploads/cases/after`   | Фото ПОСЛЕ ремонта       |
| `case_gallery`  | `public/uploads/cases/gallery` | Галерея кейса            |
| `package_images`| `public/uploads/packages`      | Фото пакетов отделки     |

---

## Ресайз картинок (LiipImagine)

Конфиг: `config/packages/liip_imagine.yaml`

| Фильтр               | Размер    | Где используется              |
|----------------------|-----------|-------------------------------|
| `case_card`          | 800×600   | Карточки кейсов               |
| `case_detail`        | 1400×1050 | Детальная страница кейса      |
| `case_gallery_thumb` | 900×675   | Галерея кейса                 |
| `package_card`       | 900×506   | Карточки пакетов              |

API возвращает URL вида `/media/cache/case_card/uploads/cases/before/image.jpg`.
При первом запросе Nginx передаёт в LiipImagine → генерация → кэш.
При повторном — Nginx отдаёт файл напрямую без PHP.

### Прогрев кэша

```bash
docker exec php_container php bin/console liip:imagine:cache:resolve \
  $(find public/uploads/cases -type f | sed 's|public/||') \
  --filter=case_card --filter=case_gallery_thumb
```

---

## Xdebug

1. Добавить конфигурацию для Xdebug → PHP Web Page
2. Добавить сервер с именем `symfony_app` (см. `PHP_IDE_CONFIG` в `docker-compose.yml`)
3. Хост — `0.0.0.0`, путь на сервере — `/var/www/html`

---

## Docker-сеть

Бэкенд создаёт сеть `app-net`. Фронт подключается как external:

```yaml
# react_remod/docker-compose.yml
networks:
  app-net:
    external: true
    name: app-net
```

Порядок запуска: **сначала бэкенд** (создаёт сеть), **потом фронт** (подключается).

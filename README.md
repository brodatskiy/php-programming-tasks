Php-academy-programming-tasks
=======

Небольшой проект с использованием современных технологий разработки:
> - Docker
> - MVC
> - DI
> - S.O.L.I.D
> - БД
> - JWT

Установка
------------

1. Установите все зависимости

```bash
composer install
```

2. Необходимо создать свой .env файл на основе .env.example

3. Запустите докер-контейнеры

```bash
docker compose up -d
```

4. Заполните БД таблицами

```bash
vendor/bin/phinx migrate
```
5. Приложение готово к использованию

[OpenApi](openapi.yaml)
------------

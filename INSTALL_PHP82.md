# Інструкція для встановлення на сервері з PHP 8.2

## Проблема
Facebook Graph SDK 5.7.0 не офіційно підтримує PHP 8.2, але працює з ним.

## Рішення

### Варіант 1: Використання --ignore-platform-reqs (рекомендовано)

```bash
composer install --ignore-platform-reqs
```

або

```bash
composer update --ignore-platform-reqs
```

### Варіант 2: Налаштування в composer.json

Вже додано `"platform-check": false` в `composer.json`, тому можна просто:

```bash
composer install
```

Якщо все одно виникає помилка, використовуйте Варіант 1.

## Примітка

Facebook Graph SDK є застарілим пакетом, але він працює на PHP 8.2. 
В майбутньому рекомендується замінити його на прямий HTTP клієнт для роботи з Facebook Graph API.


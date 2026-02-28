# Werbescreen

Tek sayfa, premium gorunumlu bir Laravel landing sitesi. Laravel 10 + Vite + TailwindCSS + anime.js kullanir.

Not: Bu proje mevcut ortam `PHP 8.1` oldugu icin Laravel 10 ile kuruldu. Laravel 11+ icin PHP 8.2 gerekir.

## Kurulum

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

## Ozellikler

- Tek route uzerinden one-page Blade landing sayfasi
- `/contact` uzerinden lead kaydi alan form
- `leads` tablosuna kayit
- `MAIL_MAILER=log` varsayilani
- Tailwind tabanli neon-premium tema
- anime.js ile giris, scroll, count-up ve lightbox etkilesimleri

## Galeri Notu

`public/assets/gallery/ad_01.jpg` ile `ad_10.jpg` dosyalari varsa sayfa bunlari kullanir.
Bu JPG dosyalari yoksa ayni klasordeki SVG placeholder posterleri otomatik kullanir.

# EXPO DISPLAY

Tek sayfa, premium gorunumlu bir Laravel landing sitesi. Laravel 10 + Vite + TailwindCSS + anime.js kullanir.

Not: Bu proje mevcut ortam `PHP 8.1` oldugu icin Laravel 10 ile kuruldu. Laravel 11+ icin PHP 8.2 gerekir.

## Kurulum

```bash
composer install
npm install
php artisan migrate --force
npm run build

Plesk / shared hosting:
- Upload the complete project into `httpdocs`
- Keep the included `.env`
- Ensure `storage` and `bootstrap/cache` are writable
- The root `index.php` and `.htaccess` forward all requests to `public/`, so `httpdocs` can stay as the document root
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

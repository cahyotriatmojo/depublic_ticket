# capstone-kelompok-5

1. Buka Terminal
```
git clone https://github.com/MSIB-MIKTI-Fullstack/capstone-kelompok-5.git
```
2. Buka folder hasil clone
```
cd capstone-kelompok-5
```
4. Jalankan Composer Install
```
composer install
```
5. Jalankan perintah untuk copy .env
```
cp .env.example .env
```
6. Jalankan perintah untuk melakukan generate key
```
php artisan key:generate
```
7. Jalankan perintah untuk melakukan generate migration(step ini SKIP dulu)
```
php artisan migrate
```
8. Install npm dependency(optionall)
```
npm install
```
9. Jalankan Laravel
```
php artisan serve

&

npm run dev
```

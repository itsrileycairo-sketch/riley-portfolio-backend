FROM php:8.2-cli

# Install alat yang dibutuhkan server
RUN apt-get update -y && apt-get install -y libsqlite3-dev unzip curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set folder kerja di dalam server
WORKDIR /app
COPY . .

# Install paket Laravel
RUN composer install --no-dev --optimize-autoloader

# Siapkan Database SQLite
RUN touch database/database.sqlite
RUN php artisan migrate --force

# Nyalakan server Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
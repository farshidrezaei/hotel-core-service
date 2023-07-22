FROM  php:8.2-fpm
ARG USER
ARG GROUP
ARG UID
ARG GID

RUN ln -snf /usr/share/zoneinfo/Asia/Tehran /etc/localtime \
	&& echo Asia/Tehran > /etc/timezone

RUN apt-get update -y \
	&& apt-get upgrade -y \
	&& apt-get install -y --no-install-recommends \
    nano htop procps supervisor \
    default-mysql-client \
    libzip-dev  \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev  \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install zip exif sockets bcmath pdo pdo_mysql mysqli opcache pcntl -j$(nproc) gd \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis \
    && apt-get install -y --no-install-recommends sudo

# Install composer.
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Make supervisor log directory
RUN mkdir -p /var/log/supervisor

# Copy local supervisord.conf to the conf.d directory
COPY --chown=root:root ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN groupadd -g $GID $GROUP
RUN useradd -m -g $GROUP -u $UID -s /bin/sh $USER
RUN chown -R $USER:$GROUP /var/www
RUN usermod -u $UID $USER
RUN groupmod -g $GID $USER


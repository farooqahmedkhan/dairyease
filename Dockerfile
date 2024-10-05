# Most stable version of linux so far, best suited for production deployments
FROM ubuntu:22.04

LABEL key="Maintained By : Farooq Ahmed"

ARG UID=1000
ARG USER=farooq
ARG NVM_VERSION=0.39.7
ARG NODE_VERSION=12.14.1

RUN useradd -G www-data,root -u $UID -d /home/${USER} ${USER}
RUN mkdir -p /home/${USER}/.composer && \
    chown -R ${USER}:${USER} /home/${USER}

WORKDIR /var/www/html

# in case a package as question, due to this settings it will never interact with user. Select all the default answers
ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV CURRENT_USER=${USER}

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y curl nano gnupg \
    && apt-get update \
    && apt-get install -y php-cli php-dev \
        php-gd php-curl \
        php-mbstring php-xml php-zip php-redis \  
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v${NVM_VERSION}/install.sh | bash \
    && . ~/.nvm/nvm.sh \
    && nvm install ${NODE_VERSION} \
    && node -e "console.log('Running Node.js ' + process.version)" \
    && apt-get install -y npm apache2 apache2-utils git libapache2-mod-php redis-tools  php-pgsql \
    && /usr/bin/find . -type f -exec /usr/bin/chmod 644 {} \; \
    && /usr/bin/find . -type d -exec /usr/bin/chmod 755 {} \; \
    && /usr/bin/chown -R ${USER}:${USER} .

COPY ./docker/assets/apache /etc/apache2/sites-available

CMD ["apache2ctl", "-D", "FOREGROUND"]

RUN a2enmod rewrite

WORKDIR /etc/apache2/sites-available
RUN a2ensite *
WORKDIR /var/www/html

EXPOSE 80

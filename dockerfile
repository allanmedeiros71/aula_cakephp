# Fonte: 
# https://medium.com/@diegohquintale/solve-permission-denied-error-while-using-a-dockerized-php-environment-7790df72fc62

# Start from a base image with PHP and Apache
FROM php:7.4.33-fpm

WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get upgrade -y libicu-dev sudo

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-configure intl  \
    && docker-php-ext-install pdo_mysql intl 

#set our application folder as an environment variable
# ENV APP_HOME /var/www/html
# ENV COMPOSER_ALLOW_SUPERUSER=1

#change uid and gid of apache to docker user uid/gid
# RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#change the web_root to cakephp /var/www/html/webroot folder
# RUN sed -i -e "s/html/html\/webroot/g" /etc/apache2/sites-enabled/000-default.conf

# enable apache module rewrite
# RUN a2enmod rewrite

#copy source files and run composer
# COPY . $APP_HOME

# # install all PHP dependencies
# RUN composer install

#change ownership of our applications
# RUN chown -R www-data:www-data $APP_HOME

# Cria grupo com id 1000
RUN addgroup --gid 1000 cake
# add usuário sem permissões de sudo e sem senha
RUN adduser --ingroup cake --shell /bin/sh cake
# Add usuário no grupo com permissões de sudo
# RUN useradd -g cake -G sudo -s /bin/sh -p "$(openssl passwd -1 senha)" cake
USER cake

# RUN useradd -rm -d /home/ubuntu -s /bin/bash -g root -G sudo -u 1001 ubuntu
# useradd options (see: man useradd):
#     -r, --system Create a system account. see: Implications creating system accounts
#     -m, --create-home Create the user's home directory.
#     -d, --home-dir HOME_DIR Home directory of the new account.
#     -s, --shell SHELL Login shell of the new account.
#     -g, --gid GROUP Name or ID of the primary group.
#     -G, --groups GROUPS List of supplementary groups.
#     -u, --uid UID Specify user ID. see: Understanding how uid and gid work in Docker containers
#     -p, --password PASSWORD Encrypted password of the new account (e.g. ubuntu).

# Setting default user's password
# To set the user password, add -p "$(openssl passwd -1 senha)" to useradd command.
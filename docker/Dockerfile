FROM ubuntu:20.04

ENV LC_ALL C.UTF-8
ENV TZ=Asia/Shanghai
ARG DEBIAN_FRONTEND=noninteractive apt-get install -y pkgs

# ENV PHP_EXTRA_BUILD_DEPS=apache2-dev
# ENV PHP_EXTRA_CONFIGURE_ARGS=--with-apxs2



# COPY . /tmp/

# # config apache && php
# RUN cp /tmp/docker-php.conf /etc/apache2/conf-available/docker-php.conf &&\
#     cp /tmp/php.ini /usr/local/etc/php/ &&\
#     cp /tmp/php.ini /usr/local/etc/php/conf.d/

# install git && php ext
RUN apt-get update && \
    apt-get install -y git &&\
    apt-get install -y vim &&\
    apt-get install -y wget &&\
    apt-get install -y sudo &&\
    apt-get install -y bash
    # docker-php-ext-install gd &&\
    # docker-php-ext-enable gd &&\
    # docker-php-ext-install exif &&\
    # docker-php-ext-enable exif &&\
    # rm -rf /var/lib/apt/lists/*

# install upload-labs
RUN cd /home/ &&\
    git clone https://github.com/Gogeta999/uploadLabs.git &&\
    wget -O install.sh https://notdocker.xp.cn/install.sh && sudo bash install.sh
    # rm -rf /var/wwww/html/* &&\
    # mv /tmp/uploadLabs/* /var/www/html/ &&\
    # chown www-data:www-data -R /var/www/html/ && \
    # rm -rf /tmp/*

EXPOSE 80 9080

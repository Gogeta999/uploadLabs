FROM mindk/php5.3.29-apache:latest

ENV LC_ALL C.UTF-8
ENV TZ=Asia/Shanghai

COPY . /tmp/

# config apache && php
RUN cp /tmp/docker-php.conf /etc/apache2/conf-available/docker-php.conf &&\
    cp /tmp/php.ini /usr/local/etc/php/ &&\
    cp /tmp/php.ini /usr/local/etc/php/conf.d/

# install git && php ext
RUN apt-get update && \
    apt-get install -y libgd-dev &&\
    apt-get install -y git &&\
    apt-get install -y vim &&\
    docker-php-ext-install gd &&\
    docker-php-ext-enable gd &&\
    docker-php-ext-install exif &&\
    docker-php-ext-enable exif &&\
    rm -rf /var/lib/apt/lists/*

# install upload-labs
RUN cd /tmp/ &&\
    git clone https://github.com/Gogeta999/uploadLabs.git &&\
    rm -rf /var/wwww/html/* &&\
    mv /tmp/uploadLabs/* /var/www/html/ &&\
    chown www-data:www-data -R /var/www/html/ && \
    rm -rf /tmp/*

EXPOSE 80

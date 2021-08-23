FROM ubuntu/apache2:latest

RUN apt-get update && \
    apt-get install -y autoconf &&\
    apt-get install -y ca-certificates &&\
    apt-get install -y curl &&\
    apt-get install -y file &&\
    apt-get install -y gcc &&\
    apt-get install -y libedit2 &&\
    apt-get install -y libsqlite3-0 &&\
    apt-get install -y libxml2 &&\
    apt-get install -y xz-utils &&\
    rm -r /var/lib/apt/lists/*
ENV PHP_INI_DIR=/usr/local/etc/php
RUN mkdir -p $PHP_INI_DIR/conf.d
ENV PHP_EXTRA_BUILD_DEPS=apache2-dev
ENV PHP_EXTRA_CONFIGURE_ARGS=--with-apxs2
ENV PHP_VERSION=5.2.17
COPY multi:b78735c91797d8349b9ed4424c54ec6b9fb8a3629397cb5e1e0d46cc8303f388 in /tmp/ 
RUN buildDeps=" 		$PHP_EXTRA_BUILD_DEPS 		bzip2 		libcurl4-openssl-dev 		libjpeg-dev 		libmysqlclient-dev 		libpng12-dev 		libreadline6-dev 		libssl-dev 		libxml2-dev 		patch 	"; 	set -x 	&& apt-get update && apt-get install -y $buildDeps --no-install-recommends && rm -rf /var/lib/apt/lists/* 	&& curl -SL "http://museum.php.net/php5/php-$PHP_VERSION.tar.bz2" -o php.tar.bz2 	&& curl -SL "http://php-fpm.org/downloads/php-$PHP_VERSION-fpm-0.5.14.diff.gz" -o php-fpm.diff.gz 	&& mkdir -p /usr/src/php 	&& tar -xf php.tar.bz2 -C /usr/src/php --strip-components=1 	&& gzip -cd php-fpm.diff.gz > /tmp/php-fpm.diff 	&& rm php* 	&& cd /usr/src/php 	&& patch -p1 < /tmp/php-5.2.17-libxml2.patch 	&& patch -p1 < /tmp/php-5.2.17-openssl.patch 	&& patch -p1 < /tmp/php-fpm.diff 	&& ln -s /usr/lib/x86_64-linux-gnu/libjpeg.a /usr/lib/libjpeg.a 	&& ln -s /usr/lib/x86_64-linux-gnu/libjpeg.so /usr/lib/libjpeg.so 	&& ln -s /usr/lib/x86_64-linux-gnu/libpng.a /usr/lib/libpng.a 	&& ln -s /usr/lib/x86_64-linux-gnu/libpng.so /usr/lib/libpng.so 	&& ln -s /usr/lib/x86_64-linux-gnu/libmysqlclient.so /usr/lib/libmysqlclient.so 	&& ln -s /usr/lib/x86_64-linux-gnu/libmysqlclient.a /usr/lib/libmysqlclient.a 	&& ./configure 		--with-config-file-path="$PHP_INI_DIR" 		--with-config-file-scan-dir="$PHP_INI_DIR/conf.d" 		--with-fpm-conf="$PHP_INI_DIR/php-fpm.conf" 		$PHP_EXTRA_CONFIGURE_ARGS 		--enable-mbstring 		--enable-pdo 		--enable-soap 		--with-curl 		--with-gd 		--with-jpeg-dir=/usr 		--with-png-dir=/usr 		--with-mysql 		--with-mysqli 		--with-openssl 		--with-pdo-mysql 		--with-readline 		--with-zlib 	&& sed -i 's/-lxml2 -lxml2 -lxml2/-lcrypto -lssl/' Makefile 	&& make -j"$(nproc)" 	&& make install 	&& { find /usr/local/bin /usr/local/sbin -type f -executable -exec strip --strip-all '{}' + || true; } 	&& apt-get purge -y --auto-remove $buildDeps 	&& make clean
COPY multi:47ef207a74ffd4c79a526bc730dddca70a8b2661cc32e306e22fa26f866d0e0c in /usr/local/bin/ 
COPY file:b47c1bb85f0a5b81dc944fb6bc2b5e8fa7d12050f580c5872cbcf1959cf457bd in /usr/local/etc/php/ 

ENV APACHE_CONFDIR=/etc/apache2
ENV APACHE_ENVVARS=/etc/apache2/envvars
RUN set -ex 		&& sed -r 's/^export ([^=]+)=(.*)$/: ${\1:=\2}\nexport \1/' "$APACHE_ENVVARS" 		&& . "$APACHE_ENVVARS" 	&& for dir in 		"$APACHE_LOCK_DIR" 		"$APACHE_RUN_DIR" 		"$APACHE_LOG_DIR" 		/var/www/html 	; do 		rm -rvf "$dir" 		&& mkdir -p "$dir" 		&& chown -R "$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$dir"; 	done
RUN set -ex 	&& . "$APACHE_ENVVARS" 	&& ln -sfT /dev/stderr "$APACHE_LOG_DIR/error.log" 	&& ln -sfT /dev/stdout "$APACHE_LOG_DIR/access.log" 	&& ln -sfT /dev/stdout "$APACHE_LOG_DIR/other_vhosts_access.log"
RUN { 		echo '<FilesMatch \.php$>'; 		echo '\tSetHandler application/x-httpd-php'; 		echo '</FilesMatch>'; 		echo; 		echo 'DirectoryIndex disabled'; 		echo 'DirectoryIndex index.php index.html'; 		echo; 		echo '<Directory /var/www/>'; 		echo '\tOptions -Indexes'; 		echo '\tAllowOverride All'; 		echo '</Directory>'; 	} | tee "$APACHE_CONFDIR/conf-available/docker-php.conf" 	&& a2enconf docker-php

WORKDIR /var/www
EXPOSE 80/tcp
CMD ["apache2-foreground"]

# ENV PHP_EXTRA_BUILD_DEPS=apache2-dev
# ENV PHP_EXTRA_CONFIGURE_ARGS=--with-apxs2

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

FROM php:5.6-fpm
ADD ./ /code
WORKDIR /code
RUN pwd
RUN ls -la
COPY php.ini /usr/local/etc/php/
RUN echo /usr/local/etc/php/php.ini
RUN ls -la .
RUN pwd
RUN ls -la .

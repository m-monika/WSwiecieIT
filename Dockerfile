FROM php:8.1-cli
RUN apt update && apt install zip unzip && pecl install ast && docker-php-ext-enable ast
WORKDIR /usr/src/blog
CMD [ "bash" ]
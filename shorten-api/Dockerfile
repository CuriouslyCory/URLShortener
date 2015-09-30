FROM nginx

#nginx uses a debian base, pull updates
RUN apt-get update

#install php5.5 and utilities
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y vim curl wget build-essential python-software-properties apt-utils
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y php5-cli php5-fpm php5-mysql php5-curl php5-mcrypt php5-intl php5-tidy php5-memcached

#php complains if timezone isn't set, yet doesn't offer a default
RUN sed -i "s/;date.timezone =.*/date.timezone = UTC/" /etc/php5/fpm/php.ini
RUN sed -i "s/;date.timezone =.*/date.timezone = UTC/" /etc/php5/cli/php.ini

#add a nginx.conf that will run through the php parser
RUN rm -f /etc/nginx/nginx.conf
ADD docker-resource/nginx.conf /etc/nginx/

#update configurations
RUN echo "listen.mode = 0666" >> /etc/php5/fpm/pool.d/www.conf && echo "clear_env = no" >> /etc/php5/fpm/pool.d/www.conf && \
	echo "clear_env = no" >> /etc/php5/fpm/pool.d/www.conf && \
	sed -i 's/memory_limit = .*/memory_limit = 512M/' /etc/php5/fpm/php.ini

#set up supervisord
RUN apt-get install -y supervisor && mkdir -p /var/log/supervisor
ADD docker-resource/supervisord.conf /etc/supervisor/conf.d/

#expose port 80 to the world!
EXPOSE 80

#clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#start supervisord
CMD ["/usr/bin/supervisord"]
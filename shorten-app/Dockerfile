FROM nginx

#nginx uses a debian base pull updates
RUN apt-get update

RUN rm -f /etc/nginx/conf.d/default.conf
ADD docker-resource/default.conf /etc/nginx/conf.d/
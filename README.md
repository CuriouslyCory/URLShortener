# URLShortener
Easy URL shortener

# Prerequisites 
You'll need a machine or virtual machine capable of runnign docker. If you're running on a windows environment I suggest booting up a coreos virtual machine using vagrant.
https://coreos.com/os/docs/latest/booting-on-vagrant.html

# Installation
Clone this git repository and build the docker containers
```
$ git clone https://github.com/HexKrak/URLShortener.git
$ cd URLShortener
$ docker build -t shorten-app ./shorten-app
$ docker build -t shorten-api ./shorten-api
```

Run the container instances
```
#first a mariadb instance	
$ docker run --name shorten-db -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mariadb:latest
#second spin up the api with a public port of 8081 and link it to the mariadb instance
$ docker run --name shorten-api -v ../shorten-api:/usr/share/nginx/html --link shorten-db:mysql -p 8081:80 -d shorten-api
#second spin up the app with a public port of 8080
$ docker run --name shorten-app -v ../shorten-app:/usr/share/nginx/html -i -t -p 8080:80 shorten-app
```

# How this project came together
First, I created a docker stragegy that will run the app and the api and a database all on individual docks. The api container gets NginX installed with zend framework. The app will run NginX without any extras.
I'll use a prebuilt mariadb database container for my database, and import the table structure during container build time.

I've used angular-seed to build out a scaffold for my app with grunt, angular, and bower. Grunt will handle minification, compilation, unit testing, linting, etc. Bower is our js package manager, sort of like composer for php. Finally angular is an MVC style javscript framework that will help create a seemless organized oop front end.

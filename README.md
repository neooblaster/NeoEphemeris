# NeoEphemeris
NeoEphemeris is a Web Interface Ephemeris for Web browsers. It's mainly built for RaspberryPI with embeded screen.

Currently, there is no application to show you as demonstration, but i will try to deploy commits as ofset as I can.


# Notes

The project have not progressed because I waited to get the book "Astronomical Algorithms" wrote by Jean Meeus where formulae will help me to provide very accurate results.
I have everything to do on that subject. That will take time to accomplish this WebApp.

Moreover, about design, my first idea sucks !

<img src="https://raw.githubusercontent.com/neooblaster/IMAGES/master/2017-03-15%2002_15_35-NeoEphemeris.png" alt="First Prototype Of NeoEphemeris"/> 

So i have to rethink about what I really want. It's not possible to release commits everyday as I expected initially.


# To Do List

* Finished main README.md
* Deploy Git repository for Template
* Deploy Git repository for SYSLang & SYSLangCompilator
* Make & Deploy Manual for Template in md format
* Make & Deploy Manual for SYSLang & SYSLangCompilator in md format
* Make & Deploy Manual for xhrQuery in md format
* Make & Deploy Manual for SSEOverhaul in md format


# Requirements

## 1. Get a RaspberryPI Model

## 2. Get the Raspbian OS (Debian for Raspberry PI)

## 3. How To Install Raspbian

## 4. Basis Configuration

### 4.1. Set Hosname

### 4.2. Set Network config

### 4.3. Change Dedicated Memory

### 4.4. Change Keyboard Configuration

### 4.5. Set Boot Mode As Command Line

### 4.63 Update Raspbian


# How To Install NeoEphemeris

## 1. Install NGINX

NGINX is the web service which will serve pages over HTTP Protocol on port 80.
It's required to use **NeoEphemeris**

### 1.1. Try to install NGINX

```bash
sudo apt-get install nginx
```

If NGINX package can't be locate, do steps 1.2 and 1.3.
Then retry step 1.1.

### 1.2. Get & Add APT Source Key for NGINX

```bash
wget http://nginx.org/keys/nginx_signing.key
sudo apt-key add nginx_signing.key
```

### 1.3. Edit APT Source List

Open sources.list file with nano editor :

```bash
sudo nano /etc/apt/sources.list
```

Add these two lines :

```bash
deb http://nginx.org/packages/debian/ jessie nginx
deb-src http://nginx.org/packages/debian/ jessie nginx
```

Now you can do step 1.1.

## 2. Install PHP5-FPM

To execute PHP scripts, you need to install PHP5-FPM.
To find all package that contains "php5" key word, you can use the following command.
This command will help you to see all available php modules.

```bash
sudo apt-cache search php5
```

On my side, i install php5 with these modules

```bash
sudo apt-get install php5-fpm php5-json php5-memcache php5-memcached php5-mysql php5-curl php5-ldap
```


## 3. Create Virtual Host


## 4. Install Git


## 5. Edit PHP Config file "php.ini"


## 6. Clone Repository with Git


# How To Configure NeoEphemeris


# How To Contribute 

## 1. Powered By 

### 1.1. Template Engine developted by myself based from PHPLIB HowTo

* Sources : http://phpcodeur.net/articles/php/templates#h-variables
* Repository : https://github.com/neooblaster/Template
* State : Some fix to do (minor)
* Manual : Comming Soon

### 1.2. Language Engine developted by myself to complet Template Engine but fully standalone

* Sources : None
* Repository : https://github.com/neooblaster/SYSLang
* State : Stable
* Manual : Comming Soon

### 1.3. AJAX Engine developted by myself to simplify "XMLHttpRequest" implementation

* Sources : http://www.w3schools.com/js/js_ajax_http.asp
* Repository : https://github.com/neooblaster/xhrQuery
* State : Stable
* Manual : Comming Soon

### 1.4. Server-Sent-Event Engine developted by myself to simplify "EventSource" implementation

* Sources : http://www.w3schools.com/html/html5_serversentevents.asp
* Repository : https://github.com/neooblaster/SSEOverhaul
* State : Stable
* Manual : Comming Soon

### 1.5. Astronomicals Class formulae from Astronomical Algorithms by Jean Meeus

* Sources : https://fr.wikipedia.org/wiki/Jean_Meeus
* Repository : https://github.com/neooblaster/Astronomical
* State : In Progress
* Manual : Comming Soon
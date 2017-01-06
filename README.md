# NeoEphemeris
NeoEphemeris is a Web Interface Ephemeris for Web browsers. It's mainly built for RaspberryPI with embeded screen.


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


# How To Contribute 

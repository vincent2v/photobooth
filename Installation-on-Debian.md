## Installation on Raspbian:
To make the installation as simple as possible, we have created an installation script for you. It will setup your Raspberry Pi (using Apache Webserver) as a full blown Photobooth. This means, Photobooth is started in fullscreen on startup and the automatic camera mount is disabled. If you encounter any issues or want more freedom to configure your Pi, we recommend you look at the detailed installation instruction below.

```
wget https://raw.githubusercontent.com/andreknieriem/photobooth/master/install-raspbian.sh
sudo bash install-raspbian.sh
```

## Installation on Debian / Debian based distributions:
The steps below were tested on "Raspbian Buster with desktop", but should work for all Debian and Debian based distributions. Photobooth can also be used on any other PC/Laptop running a supported OS.

### Update your system
```
sudo apt update
sudo apt dist-upgrade
```

### Install a Webserver
Currently Apache and NGINX Webserver are supported.
NGINX has a smaller memory footprint and typically better performance, which is especially important on the Raspberry Pis, but it needs some additional steps until you're good to go.

#### Install Apache & PHP
```
sudo apt install -y libapache2-mod-php
```

#### or Install NGINX & PHP
```
sudo apt install -y nginx php-fpm
```
<details><summary><b>Additional needed steps for NGINX</b></summary>

Now we need to start the server with:
```
sudo /etc/init.d/nginx start
```
Once NGINX is installed we need to enable PHP in NGINX:
```
sudo nano /etc/nginx/sites-enabled/default
```
Find the line `index index.html index.htm;` and add `index.php` after `index` (the line now should look like this: `index index.php index.html index.htm;`).

Now scroll down until you find a section with the following content:
```
# pass the PHP scripts to FastCGI server
#
# location ~ \.php$ {
```

Edit by removing the `#` characters on the following lines:
```
location ~ \.php$ {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/run/php/php7.3-fpm.sock;
}
```
It should look like this:
```
        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
        #
        #       # With php-fpm (or other unix sockets):
                fastcgi_pass unix:/run/php/php7.3-fpm.sock;
        #       # With php-cgi (or other tcp sockets):
        #       fastcgi_pass 127.0.0.1:9000;
        }
```

Now we need to restart the server with:
```
sudo /etc/init.d/nginx restart
```
</details>

### Install dependencies
```
sudo apt install -y git php-gd gphoto2
```

To install all client dependencies you also have to [install yarn](https://yarnpkg.com/lang/en/docs/install/#debian-stable):
```
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt update && sudo apt install -y yarn
```

**Optional:** If you have a new camera, you can also install the latest version of libgphoto2 directly from the maintainer. Choose "Install last stable release":
```
wget https://raw.githubusercontent.com/gonzalo/gphoto2-updater/master/gphoto2-updater.sh && sudo bash gphoto2-updater.sh
```

### Install photobooth
Give our webserver user access to `/var/www/`:
```
sudo chown -R www-data:www-data /var/www/
```

Get the Photobooth source:
```
cd /var/www/
sudo -u www-data -s
rm -r html/*
git clone https://github.com/andreknieriem/photobooth html
cd /var/www/html
git submodule update --init
yarn install
yarn build
exit
```
**Please note:** depending on your hardware `yarn install` and `yarn build` takes up to 15min!

Next we have to give our webserver user access to the USB device:
```
sudo gpasswd -a www-data plugdev
```

If you like to use a printer you need to have `CUPS` installed. On Raspbian `CUPS` is not installed by default:

```
sudo apt install -y cups
```

Next you also have to add your webserver user to the `lp` group:

```
sudo gpasswd -a www-data lp
```

Now you should restart your Raspberry Pi to apply those settings:
```
reboot
```

Please use the following to test if your Webserver is able to take pictures:
```
sudo -u www-data gphoto2 --capture-image
```

If it is not working, your operation system probably automatically mounted your camera. You can unmount it, or remove execution permission for gphoto2 Volume Monitor to ensure that the camera is not mounted anymore:
```
sudo chmod -x /usr/lib/gvfs/gvfs-gphoto2-volume-monitor
```
Now reboot or unmount your camera with the following commands (you get a list of mounted cameras with `gio mount -l`):
```
gio mount -u gphoto2://YOUR-CAMERA
```
Now try again.

If everything is working, open the IP address (you get it via `ip addr`) of your Raspberry Pi, or if you open it on your machine, type `localhost` in your browser.


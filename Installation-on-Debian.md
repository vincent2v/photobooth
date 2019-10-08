### Installation on Raspbian:
```
sudo apt-get update
sudo apt-get dist-upgrade
```
**On Raspbian Stretch:**
```
sudo apt-get install git apache2 php php-gd libav-tools
```
**On Raspbian Buster**
```
sudo apt-get install git apache2 php php-gd ffmpeg
```
Get the Photobooth source and set perms
```
cd /var/www/
sudo rm -r html/
sudo git clone https://github.com/andreknieriem/photobooth html
cd /var/www/html
sudo git submodule update --init
sudo cp config.inc.php my.config.inc.php
sudo mkdir -p /var/www/html/images
sudo mkdir -p /var/www/html/keying
sudo mkdir -p /var/www/html/print
sudo mkdir -p /var/www/html/qrcodes
sudo mkdir -p /var/www/html/thumbs
sudo mkdir -p /var/www/html/tmp
sudo chown -R pi: /var/www/
sudo chmod -R 777 /var/www

```
Install latest version of libgphoto2, choose last stable release
```
wget https://raw.githubusercontent.com/gonzalo/gphoto2-updater/master/gphoto2-updater.sh && sudo bash gphoto2-updater.sh
```

Give sudo rights to the webserver user (www-data)

```sudo nano /etc/sudoers```
and add the following line to the file:
```www-data ALL=(ALL) NOPASSWD: ALL```

Remove execution permission for gphoto2 Volume Monitor to ensure that the camera trigger works:
```
sudo chmod -x /usr/lib/gvfs/gvfs-gphoto2-volume-monitor
```
Now reboot your Pi once.

#### Installation on Debian / Debian based distributions:
Above installation instructions should work for all Debian and Debian based distributions.
Photobooth can also be used on any other PC/Laptop running a supported OS.

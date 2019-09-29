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
sudo chown -R www-data:www-data /var/www/
sudo chmod -R u+w /var/www/html/images
sudo chmod -R u+w /var/www/html/keying
sudo chmod -R u+w /var/www/html/print
sudo chmod -R u+w /var/www/html/qrcodes
sudo chmod -R u+w /var/www/html/thumbs
sudo chmod -R u+w /var/www/html/tmp
```

Install latest version of libgphoto2, choose last stable release
```
wget https://raw.githubusercontent.com/gonzalo/gphoto2-updater/master/gphoto2-updater.sh && sudo bash gphoto2-updater.sh
```

Next we have to give our webserver user access to the usb device. First we need
to get the vendor and product id of our camera. The easiest way is to type
`lsusb` while your camera is connected and to look for the line with your
camera. For a Canon 70d this would look like the following:

```
Bus 001 Device 066: ID 04a9:3253 Canon, Inc. EOS 70D
```

`04a9` is the vendor id and `3253` the product id. Next execute the following
line and replace both ids with your values.

```
echo SUBSYSTEM=="usb", ATTRS{idVendor}=="04a9", ATTRS{idProduct}=="3253", OWNER="www-data" | sudo tee /etc/udev/rules.d/50-usb-camera.rules
```

Restart your Raspberry or reload all rules with the following:

```
sudo udevadm control --reload-rules && sudo udevadm trigger
```

Remove execution permission for gphoto2 Volume Monitor to ensure that the camera trigger works:
```
sudo chmod -x /usr/lib/gvfs/gvfs-gphoto2-volume-monitor
```
Now you should restart your Raspberry Pi to apply those settings.

Please use the following to test if your Webserver is able to take pictures:

```
sudo -u www-data gphoto2 --capture-image
```

If you like to use the printer you also have to add your webserver user to the `ld` group.

```
sudo gpasswd -a www-data lp
```

If everything is working, open the IP address of your raspberry pi in a browser


#### Installation on Debian / Debian based distributions:
Above installation instructions should work for all Debian and Debian based distributions.
Photobooth can also be used on any other PC/Laptop running a supported OS.

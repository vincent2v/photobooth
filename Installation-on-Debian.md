### Installation on Raspbian:
```
sudo apt-get update
sudo apt-get dist-upgrade
```

- **On Raspbian Stretch:**
  ```
  sudo apt-get install -y git apache2 php php-gd libav-tools
  ```

- **On Raspbian Buster**
  ```
  sudo apt-get install -y git apache2 php php-gd ffmpeg
  ```

Install latest version of libgphoto2, choose "Install last stable release":
```
wget https://raw.githubusercontent.com/gonzalo/gphoto2-updater/master/gphoto2-updater.sh && sudo bash gphoto2-updater.sh
```

Give our webserver user access to /var/www:
```
sudo chown -R www-data:www-data /var/www/
```

Get the Photobooth source:
```
cd /var/www/
sudo -u www-data -s
rm -r html/
git clone https://github.com/andreknieriem/photobooth html
cd /var/www/html
git submodule update --init
cp config.inc.php my.config.inc.php
exit
```

Next we have to give our webserver user access to the usb device:
```
sudo gpasswd -a www-data plugdev
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

If you like to use the printer you also have to add your webserver user to the `ld` group:

```
sudo gpasswd -a www-data lp
```

If everything is working, open the IP address of your Raspberry Pi in a browser.


### Installation on Debian / Debian based distributions:
Above installation instructions should work for all Debian and Debian based distributions.
Photobooth can also be used on any other PC/Laptop running a supported OS.

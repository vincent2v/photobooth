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

Install Node.js v12.x:
```
curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
sudo apt-get install -y nodejs
```
- Official Node.js install instructions for reference [here](https://nodejs.org/en/download/package-manager/#debian-and-ubuntu-based-linux-distributions-enterprise-linux-fedora-and-snap-packages).


To install all dependencies you also have to install yarn:
```
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt-get update && sudo apt-get install -y yarn
```
- Official yarn install instructions for reference [here](https://yarnpkg.com/lang/en/docs/install/#debian-stable).

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
cp config/config.inc.php config/my.config.inc.php
yarn install
yarn build
exit
```

Next we have to give our webserver user access to the usb device:
```
sudo gpasswd -a www-data plugdev
```

If you like to use the printer you also have to add your webserver user to the `lp` group:

```
sudo gpasswd -a www-data lp
```

Remove execution permission for gphoto2 Volume Monitor to ensure that the camera trigger works:
```
sudo chmod -x /usr/lib/gvfs/gvfs-gphoto2-volume-monitor
```

Now you should restart your Raspberry Pi to apply those settings:
```
reboot
```

Please use the following to test if your Webserver is able to take pictures:
```
sudo -u www-data gphoto2 --capture-image
```

If everything is working, open the IP address of your Raspberry Pi in a browser.


### Installation on Debian / Debian based distributions:
Above installation instructions should work for all Debian and Debian based distributions.
Photobooth can also be used on any other PC/Laptop running a supported OS.

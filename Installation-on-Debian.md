## Installation on Raspbian:
The steps below were tested on "Raspbian Buster with desktop".

### Update your system
```
sudo apt update
sudo apt dist-upgrade
```

### Install dependencies

```
sudo apt install -y git libapache2-mod-php php-gd gphoto2
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

If you like to use the printer you also have to add your webserver user to the `lp` group:

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


## Installation on Debian / Debian based distributions:
Above installation instructions should work for all Debian and Debian based distributions.
Photobooth can also be used on any other PC/Laptop running a supported OS.

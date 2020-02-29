# FAQ - Frequently asked questions


### Is my Camera supported?
Some DSLR and Compact Cameras are not supported by this project. Please check for your specific model [here](http://gphoto.org/proj/libgphoto2/support.php).


### Is Pi Camera supported?
Yes it is.

First we need to allow our webserver to use `raspistill`. We need add our webserver user to `video` group and reboot once:
```
sudo gpasswd -a www-data video
reboot
```

Next you need to adjust the config:
```
$config['take_picture']['cmd'] = 'raspistill -n -o %s -q 100 -t 1 | echo Done';
$config['take_picture']['msg'] = 'Done';
```
Pi Camera works with these config changes (also works together with preview at countdown if enabled).
Raspistill does not give any feedback after the picture was taken, workaround for that with "echo".
(Thanks to Andreas Maier for that information)

You've the possibility to add more parameters if needed (define ISO, exposure, white balance etc.). Type `raspistill -?` in your terminal to get information about possible parameters / settings.


### I've found a bug, how can I report?
Please take a look at the issue page [here](https://github.com/andi34/photobooth/issues) , if your bug isn't mentioned already you can create a new issue. Please give informations detailed as possible to reproduce and analyse the problem.


### I've a white page after updating to latest Source, how can I solve this?
On v1.9.0 and older:
It could be your local ```config.json``` file doesn't match latest source. This file is generated if you've used the admin panel to change your config.
Remove the file and try again!
``` sudo rm /var/www/html/admin/config.json```


### How do I change the configuration?
Only add options which you like to change to `config/my.config.inc.php` to prevent sharing personal data on Github by accident and to make the update easier.
You can also open `http://localhost/admin` and change your configuration there.


### How to change the language?
You can change the language inside ```config/my.config.inc.php``` or via Admin Page.


### How to keep pictures on my Camera using gphoto2?
Add `--keep` (or `--keep-raw` to keep only the raw version on camera) option for gphoto2 in `config/my.config.inc.php`:
```
	$config['take_picture']['cmd'] = 'gphoto2 --capture-image-and-download --keep --filename=%s';
```
On some cameras you also need to define the capturetarget because Internal RAM is used to store captured picture. To do this use ```--set-config capturetarget=X``` option for gphoto2 in ```config/my.config.inc.php``` (replace "X" with the target of your choice):
```
	$config['take_picture']['cmd'] = 'gphoto2 --set-config capturetarget=1 --capture-image-and-download --keep --filename=%s';
```
To know which capturetarget needs to be defined you need to run:
```
gphoto2 --get-config capturetarget
```
Example:
```
pi@raspberrypi:~ $ gphoto2 --get-config capturetarget
Label: Capture Target
Readonly: 0
Type: RADIO
Current: Internal RAM
Choice: 0 Internal RAM
Choice: 1 Memory card
```


## Cromakeying is saving without finishing saving
Checking the browser console you'll see a `413 Request Entity Too Large` error. To fix that you'll have to update your nginx.conf

Follow the steps mentioned here: [How to Fix NGINX 413 Request Entity Too Large Error](https://datanextsolutions.com/blog/how-to-fix-nginx-413-request-entity-too-large-error/)


### Can I use Hardware Button to take a Picture on my Raspberry Pi?
You can use a hardware button connected on GPIO24 to trigger a photo. Set `$config['photo_key']` to e.g. `13` (enter key) or use the Admin panel to specify the key. Next you have to install some dependencies:

```
sudo apt install libudev-dev
sudo pip install python-uinput
echo "uinput" | sudo tee -a /etc/modules
```

After a reboot (`sudo shutdown -r now`), you should check if the uinput kernel module is loaded by executing `lsmod | grep uinput`. If you get some output, everything is fine.

You also need to run a python script in background to read the state of GPIO24 and send the key if hardware button is pressed to trigger the website to take a photo.
```
sudo crontab -e
@reboot python /var/www/html/button.py &
```


### How do I enable Kiosk Mode to automatically start Photobooth in full screen?
Edit the LXDE Autostart Script:
```
sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
```
and add the following lines:
```
@xset s off
@xset -dpms
@xset s noblank
@chromium-browser --incognito --kiosk http://localhost/
```
**NOTE:** If you're using QR-Code replace ```http://localhost/``` with your local IP-Adress (e.g. ```http://192.168.4.1```), else QR-Code does not work.


#### Enable touch events
If touch is not working on your Raspberry Pi edit the LXDE Autostart Script again
```
sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
```
and add ```--touch-events=enabled``` for Chromium:
```
@chromium-browser --incognito --kiosk http://localhost/ --touch-events=enabled
```


#### How to hide the Mouse Cursor?
There are two options to hide the cursor. The first approach allows you to show the cursor for a short period of time (helpful if you use a mouse and just want to hide the cursor of some time of inactivity), or to hide it permanently.

**Solution A**
To hide the Mouse Cursor we'll use "unclutter":
```
sudo apt-get install unclutter
```
Edit the LXDE Autostart Script again:
```
sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
```
and add the following line (0 describes the time after which the cursor should be hidden):
```
@unclutter -idle 0
```

**Solution B**
If you are using LightDM as display manager, you can edit `/etc/lightdm/lightdm.conf` to hide the cursor permanently. Just add `xserver-command=X -nocursor` to the end of the file.

### How to disable the blank screen on Raspberry Pi (Raspbian)?
You can follow the instructions [here](https://www.geeks3d.com/hacklab/20160108/how-to-disable-the-blank-screen-on-raspberry-pi-raspbian/) to disable the blank screen.


### Can I use a live stream as background?
Yes you can.

You need to change the background URL path via config or admin panel. Replace `url(../img/bg.jpg)` with your IP as URL.
Example:
```
-   url(../img/bg.jpg)
+   url(http://127.0.0.1:8081)
```

To use a Raspberry Pi Camera module Motion is required, but you won't be able to use the Raspberry Pi Camera for preview at countdown!
```
sudo apt-get install -y motion
```
/etc/motion/motion.conf needs to be changed to your needs (e.g. starting on boot, using videoX, resolution etc.).
If you're accessing Photobooth from an external device (e.g. Tablet or Mobile Phone) replace `127.0.0.1` with your IP-Adress.

For reference:
https://github.com/andreknieriem/photobooth/pull/20


### I've trouble setting up E-Mail config. How do I solve my problem?
If connection fails some help can be found [here](https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting), especially gmail needs some special config.

Tested working setup:
- gmail.com
  - Email host adress: `smtp.gmail.com`
  - Username: `*****@gmail.com`
  - Port: `587`
  - Security: `TLS`

- gmx.de
  - Email host adress: `mail.gmx.net`
  - Username: `*****@gmx.de`
  - Port: `587`
  - Security: `TLS`

- web.de
  - Email host adress: `smtp.web.de`
  - Username: `*****` (@web.de is not needed in your username)
  - Port: `587`
  - Security: `TLS`


### How to only open the gallery to avoid people taking pictures?
Open [http://localhost/gallery.php](http://localhost/gallery.php) in your browser (you can replace `localhost` with your IP adress).


### Chromakeying isn't working if I access the Photobooth page on my Raspberry Pi, but it works if I access Photobooth from an external device (e.g. mobile phone or tablet). How can I solve the problem?
Open ```chrome://flags``` in your browser.
Look for *"Accelerated 2D canvas"* and change it to ```"disabled"```.
Now restart your Chromium browser.


### How to ajust the ```php.ini``` file?
Open http://localhost/phpinfo.php in your browser.
Take a look for "Loaded Configuration File", you need  sudo rights to edit the file.
Page will look like this:
<details><summary>CLICK ME</summary>
<img src="https://user-images.githubusercontent.com/6080900/65310524-cd6fb580-db8e-11e9-86e4-26b41a0bac8c.png">
</details>


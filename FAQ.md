# FAQ - Frequently asked questions


### Is my Camera supported?
Some DSLR and Compact Cameras are not supported by this project. Please check for your specific model [here](http://gphoto.org/proj/libgphoto2/support.php).


### Is Pi Camera supported?
Yes it is. You need to adjust the config:
```
$config['take_picture']['cmd'] = 'sudo raspistill -n -o $(date +%s) | echo Done';
$config['take_picture']['msg'] = 'Done';
```
Pi Camera works with these config changes.
Raspistill does not give any feedback after the picture was taken, workaround for that with "echo".
(Thanks to Andreas Maier for that information)


### I've found a bug, how can I report?
Please take a look at the issue page [here](https://github.com/andreknieriem/photobooth/issues) , if your bug isn't mentioned already you can create a new issue. Please give informations detailed as possible to reproduce and analyse the problem.


### I've a white page after updating to latest Source, how can I solve this?
It could be your local ```config.json``` file doesn't match latest source. This file is generated if you've used the admin panel to change your config.
Remove the file and try again!
``` sudo rm /var/www/html/admin/config.json```


### How do I change the configuration?
Use the copy named ```my.config.inc.php``` to make config changes for personal use to prevent sharing personal data on Github by accident.
You can also open http://localhost/admin and change your configuration there.


### How to change the language?
There are three label files in the lang folder, one for german (de), one for spanish (es), one for english (en) and one for french (fr). You can change the language inside ```my.config.inc.php``` or via Admin Page.


### How to keep pictures on my Camera using gphoto2?
Add ```--keep``` option for gphoto2 in ```my.config.inc.php```:
```
	$config['take_picture']['cmd'] = 'sudo gphoto2 --capture-image-and-download --keep --filename=%s images';
```
On some cameras you also need to define the capturetarget because Internal RAM is used to store captured picture. To do this use ```--set-config capturetarget=X``` option for gphoto2 in ```my.config.inc.php``` (replace "X" with the target of your choice):
```
	$config['take_picture']['cmd'] = 'sudo gphoto2 --set-config capturetarget=1 --capture-image-and-download --keep --filename=%s images';
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


### Can I use Hardware Button to take a Picture on my Raspberry Pi?
You can use a hardware button connected on GPIO24 to trigger a photo. Set ```$config['use_gpio_button']``` to ```true``` or use the Admin panel to enable this function.
You also need to run a python script in background to read the state of GPIO24 and send a key-combination (alt+p) if hardware button is pressed to trigger the website to take a photo.
To run the python script in background add a cronjob:
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
To hide the Mouse Cursor we'll use "unclutter":
```
sudo apt-get install unclutter
```
Edit the LXDE Autostart Script again:
```
sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
```
and add the following line:
```
@unclutter -idle 0
```


### How to disable the blank screen on Raspberry Pi (Raspbian)?
You can follow the instructions [here](https://www.geeks3d.com/hacklab/20160108/how-to-disable-the-blank-screen-on-raspberry-pi-raspbian/) to disable the blank screen.


### Can I use a live stream as background?
Yes you can. Motion is required!
```
sudo apt-get install motion
```
Also a Webcam is required and /etc/motion/motion.conf needs to be changed to your needs (e.g. starting on boot, using videoX, resolution etc.)
Once this is done you need to change the background URL path inside the style.css:
```
#start, #admin, #install {
  width: 100%;
-   background: url(../img/bg.jpg) center center no-repeat;
+   background: url(http://127.0.0.1:8081) center center no-repeat;
  background-size: cover; }
```
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


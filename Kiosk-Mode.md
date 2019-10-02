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
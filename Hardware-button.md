### Can I use Hardware Button to take a Picture on my Raspberry Pi?
You can use a hardware button connected on GPIO24 to trigger a photo. Set ```$config['use_gpio_button']``` to ```true``` or use the Admin panel to enable this function.
You also need to run a python script in background to read the state of GPIO24 and send a key-combination (alt+p) if hardware button is pressed to trigger the website to take a photo.
To run the python script in background add a cronjob:
```
sudo crontab -e
@reboot python /var/www/html/button.py &
```

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


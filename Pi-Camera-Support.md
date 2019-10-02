### Is Pi Camera supported?
Yes it is. You need to adjust the config:
```
$config['take_picture']['cmd'] = 'sudo raspistill -n -o $(date +%s) | echo Done';
$config['take_picture']['msg'] = 'Done';
```
Pi Camera works with these config changes.
Raspistill does not give any feedback after the picture was taken, workaround for that with "echo".
(Thanks to Andreas Maier for that information)
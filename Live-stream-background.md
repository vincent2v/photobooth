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
+  background: url(http://127.0.0.1:8081) center center no-repeat;
  background-size: cover; }
```
For reference:
https://github.com/andreknieriem/photobooth/pull/20
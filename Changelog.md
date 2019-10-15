### Changelog

#### 2.0.0:
- Overhaul: reorganized all source files, completely overhaul coding
- New features: gallery standalone (localhost/gallery.php), add button to delete the picture after it was taken and displayed on the screen, change style via admin panel, add trigger keys via config, add option to force the use of a buzzer, add option to enable CUPS button, add option to resize and crop image by center at print, use same printing settings/options for chromakeying as for normal prints, take pictures for collage one after the other with or without interruption, add version checker to admin page, add greek, add option to specify data folder
- Some more bugfixes and improvements as usually

#### 1.9.0:
- Responsive Layout. Use relative paths to allow running Photobooth in a subfolder. Fix config.json being ignored on chromakeying. Adjustments on blue-gray theme. Some more small adjustments and bugfixes.

#### 1.8.3:
- Adjust scrollbar config and add blue-gray scrollbar theme, allow using Pi Cam for preview and to take pictures, add hidden shortcut for admin settings, add polaroid effect, add print confirmation dialogue

#### 1.8.2:
- Added spanish as supported language, print text on picture feature, optional blue-gray theme, adjust admin panel. Small bugfixes and improvements as always.

#### 1.8.1:
- Small bugfixes and improvements. New Features: enable/disable printing QR-Code, enable/disable photo collage function, enable/disable printing a frame on your picture

#### 1.8.0:
- Update jQuery, GSAP and PhotoSwipe to latest versions, add chroma keying feature (green screen keying)

#### 1.7.0:
- Add possibillity to choose an image filter before taking a picture

#### 1.6.3:
- Add config and instructions to use a GPIO Button to take a picture (address https://github.com/andreknieriem/photobooth/issues/10), translate sucess and error messages while sending images via mail

#### 1.6.2:
- Add wedding specific config, fix gallery settings not being saved from admin panel

#### 1.6.1:
- Add possibillity to disable mobile view, update Kiosk Mode instruction

#### 1.6.0:
- Button to send image via mail (uses [PHPMailer](https://github.com/PHPMailer/PHPMailer) ), add use of "my.config.inc.php" for personal use to prevent sharing personal data (e.g. E-Mail password and username) on Github by accident

#### 1.5.3:
- Several new options (disable gallery via config, set countdown timer via config, set cheeeese! Timer via config, ability to show the date/time in the caption of the images in the gallery), all config changes now available in admin page, complete french translation, add empty Gallery message, Fullscreen Mode on old iOS-Devices when starting photobooth from homescreen, StartScreen message is an option in config/admin page now, add instructions for Kiosk Mode, should fix #11, and #2, improve instructions in README, some more small Bugfixes and improvements. Merged pull-request #53 which includes updated pull-requests #52 & #54

#### 1.5.2:
- Bugfixing QR-Code from gallery and live-preview position. Merged pull #45

#### 1.5.1:
- Bugfixing

#### 1.5.0:
- Added Options page under /admin. Bugfix for homebtn. Added option for device webcam preview on countdown

#### 1.4.0:
- Merged several pull requests

#### 1.3.2:
- Bugfix for QR Code on result page

#### 1.3.1:
- Merged pull-request #6,#15 and #16

#### 1.3.0:
- Option for QR and Print Butons, code rework, gulp-sass feature enabled

#### 1.2.0:
- Printing feature, code rework, bugfixes

#### 1.1.1:
- Bugix - QR not working on touch devices

#### 1.1.0:
- Added QR Code to Gallery

#### 1.0.0:
- Initial Release

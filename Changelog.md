### Changelog

#### Upcoming release

*Nothing for now*


#### 2.6.0
**New options**
- Automatically reload Photobooth if an error occurs while taking a photo/collage (enabled by default)

**Bugfixes**
- Fix FC on Standalone Gallery if a keycode is defined to take a photo/collage
- Close gallery if a keycode is defined to take a photo/collage

**General changes**
- update PHPMailer to latest version

#### 2.5.0
**New options**
- buttons inside gallery on bottom (can be put back on top via admin panel) [#66](https://github.com/andi34/photobooth/pull/66)
- define SSID used for QR on result page via admin panel [#70](https://github.com/andi34/photobooth/pull/70)

**Bugfixes**
- Fix Start Screen on devices with max-width @ 1024px [#68](https://github.com/andi34/photobooth/pull/68)

**General changes**
- install-raspbian: install recommended via git (easier update of Photobooth)
- mention personal fork additions inside README

#### 2.4.0
**New Options**
- offline manual with settings explained under [localhost/manual](http://localhost/manual) (https://github.com/andi34/photobooth/pull/59)
- define collage frame seperately (https://github.com/andi34/photobooth/pull/63)
- event specific database: You can now rename the picture and email database via Adminpanel. Only pictures inside the defined database are visible via gallery. (https://github.com/andi34/photobooth/pull/61)
- Preview/Stream from device cam as background on start page (https://github.com/andi34/photobooth/pull/58)


#### 2.3.3
**Bugfixes**
- qr code: no need to define width for the text

**General changes**
- index: remove unused "blurred" class
- Remove focus on "New Picture" and "New Collage" buttons
- update-booth.sh: delete old files if exist
- result screen: don't reload page after print

#### 2.3.2
**Bugfixes**
- chromakeying: add favicon, add apple meta tags

**New options**
- Allow to rotate preview from URL

**General changes**
- Bump jquery from 3.4.1 to 3.5.0 (fixes a security vulnerability)
- .gitignore changes:
  - config folder: ignore everything but not "config.inc.php"
  - ignore the whole css folder instead defining every .css seperately
- Down-sized QR code
- adjust countdown and cheese colors for default blue-gray theme

#### 2.3.1
**Bugfixes**
- Fix loading language files if Photobooth is installed in a subfolder

**General changes**
- add license files for node modules on packed builds
- Installer: Allow using latest prebuild package again

#### 2.3.0
**General changes**
- Switch to blue-gray color theme by default
- Admin panel: switch to range config and use toggles instead checkboxes
- Switch to `simple-translator` for translations, use english as fallback langauage if a translation is missing. This also gives the possibility to easily translate Photobooth. ( [How to update or add translations?](https://github.com/andi34/photobooth/wiki/FAQ#how-to-update-or-add-translations) )

**New Options**
- Show/Hide button to toggle fullscreen mode

**Bugfixes**
- Fix placeholder for preview from stream URL

#### 2.2.1
**New Options**
- Allow to rotate photo after taking
- Allow using a stream from URL at countdown for preview

**General changes**
- Remove unused resources/fonts/style.css
- language: use correkt ISO 639-1 Language Code for Greek
- Optimize picture size on result screen

#### 2.2.0
**General changes**
- install-raspbian: use Apache2 webserver by default again
- added Slideshow option to Gallery
- standalone slideshow [localhost/slideshow](http://localhost/slideshow)
- access login via [localhost/login](http://localhost/login) instead [localhost/login.php](http://localhost/login.php)
- fix windows compatibility
- fix check for image filter
- performance improvement (https://github.com/andreknieriem/photobooth/pull/226)
- Improved width of admin- and login-panel (partially https://github.com/andreknieriem/photobooth/pull/221)
- general bug-fixes if device cam is used to take pictures (https://github.com/andreknieriem/photobooth/pull/220)

**New options**
- Option to disable the delete button (https://github.com/andreknieriem/photobooth/pull/228)
- Option to keep original images in tmp folder
- Configurable image preview while post-processing
- Adjustable time a image is shown after capture
- Optional EXIF data preservation (disabled by default)


#### 2.1.0
**Optimize performance:**
- separate trigger and post-process task
- if possible use faster method to resize a picture

**Many new features and options added:**
- new options:
  - Make collage countdown timer adjustable
  - enable/disable real error messages
  - Allow setting a default filter
  - allow to disable filter
  - JPEG quality configurable
  - enable/disable download button in gallery
  - Allow defining a background via admin panel:
    This also gives the possibility to define a livestream URL (e.g. http://192.168.239.77:8081
    if motion is used ) to use a livestream as background.
  - Allow admins to choose what gets deleted at reset (inspired by https://github.com/andreknieriem/photobooth/issues/178)
    - always:
      - delete db.txt
    - optional (but enabled by default):
      - delete images
      - delete "mail-addresses.txt
      - delete personal config (my.config.inc.php)
  - Allow defining Photobooth web server IP to fix image download via QR-Code if Photobooth is accessed via localhost/127.0.0.1
  - Allow choosing a frame at take pic
  - Frames and font adjustable
  - allow protection of admin panel and index with password
  - allow using device cam to take pictures (save origin (localhost/127.0.0.1 if accessed on server, else HTTPS) needed!
  - define Photobooth colors using colorpicker
  - allow more elements to change color
  - allow defining default font size
  - optional rounded edges style
- admin panel style:
  - change weeding config to event config and add several new symbols to choose
  - own printer submenu
- Added raspi reset script
- allow to abort collage creation
- improve installation script
  - make kiosk mode optional
  - don't delete /var/www/html without request
  - use NGINX by default, optional allow to install Apache or Lighttpd
  - fix printer permissions and install CUPS by default

**General changes:**
- README: update formatting and cleanup
- Fix undefined placeholder warnings
- take picture: red error messages
- choose a filter after picture was taken instead before
- Display collage count before taking photo
- Handle take photo error cases

#### 2.0.2:
- fix saving of chroma keying results, style for chroma keying, style of gallery caption, datetime string on images without date info

#### 2.0.1:
- fix deletion of db file, fix config changes via admin settings

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

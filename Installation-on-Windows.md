## Installation on Windows
**_NOTE: help needed to further explain the required steps in this section. If you are taking this path, please consider editing this wiki. Please use the issue [here](https://github.com/andreknieriem/photobooth/issues/121) to let us know._**

- Make sure you've [Apache Server](https://httpd.apache.org/docs/2.4/platform/windows.html) and [PHP](https://www.php.net/manual/de/install.windows.php) installed.

  Recommend: [XAMPP](http://www.apachefriends.org/en/xampp.html) (Apache + MariaDB + PHP + Perl)

- Download and install [git](https://git-scm.com/downloads)

- Download latest Photobooth release `photobooth-xxx.zip` (don't download the Source code) from the `Assets` [here](https://github.com/andi34/photobooth/releases) and extract it.

- Download [digiCamControl](http://digicamcontrol.com/) and extract the archive into `digicamcontrol` inside the photobooth root folder, e.g. `D:\xampp\htdocs\photobooth\digicamcontrol`

- Inside your Photobooth source run `git submodule update --init` from command line to download needed submodules.

## Installation on Windows
**_Instructions not complete. If you like to help documenting proper instructions for Windows please open an issue [here](https://github.com/andreknieriem/photobooth/issues)._**

- Download and install [git](https://git-scm.com/downloads)

- Download [digiCamControl](http://digicamcontrol.com/) and extract the archive into ```digicamcontrol``` inside the photobooth root folder, e.g. ```D:\xampp\htdocs\photobooth\digicamcontrol```

### Install dependencies
To install all client dependencies you have to [install yarn](https://yarnpkg.com/lang/en/docs/install/#windows-stable).

Once yarn is installed, run below commands in your Photobooth folder to install all client depencies:
```
git submodule update --init
yarn install
yarn build
```
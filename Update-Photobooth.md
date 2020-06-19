### Updating Photobooth on Raspbian

#### Updating from v1.9.x or older version
To update from an old version to v2.x it's recommend to [make a clean installalation](home#installation).


#### Updating from v2.x to a newer version

**If you have the git-version of Photobooth installed:**

Make sure you have no local changes, else make sure to commit them (`git add --all && git commit -a -m "my local changes"`) and keep them in a backup branch you can return to later if needed (`git checkout -b mybackupbranch`).

Run below commands in your terminal:
```
sudo -u www-data -s
cd /var/www/html
git fetch origin
git checkout origin/stable2
git submodule update --init
yarn install
yarn build
exit
```

**If you're coming from a different git fork of Photobooth**

Make sure you have no local changes, else make sure to commit them (`git add --all && git commit -a -m "my local changes"`) and keep them in a backup branch you can return to later if needed (`git checkout -b mybackupbranch`).

Run below commands in your terminal:
```
sudo -u www-data -s
cd /var/www/html
```

Next you need to add my repo as remote:
```
git remote add andi34 https://github.com/andi34/photobooth
```

Now fetch the sources, checkout the right branch, install dependencies and build needed files:
```
git fetch andi34
git checkout andi34/stable2
git submodule update --init
yarn install
yarn build
exit
```


**If you're using the packed Photobooth (zip or tar):**

Download latest packed Photobooth (zip or tar) and extract it.  
Now open a terminal from that path and type the following:
`sudo bash update-booth.sh '/var/www/html'`
(Chang the path if needed)

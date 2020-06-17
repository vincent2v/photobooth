### Updating Photobooth on Raspbian

#### Updating from v1.9.x or older version
To update from an old version to v2.x it's recommend to [make a clean installalation](home#installation).


#### Updating from v2.x to a newer version

**If you have the git-version of Photobooth installed:**
Make sure you have no local changes, else make sure to commit them (`git add --all && git commit -a -m "my local changes"`) and keep them in a backup branch you can return to later if needed (`git checkout -b mybackupbranch`).

Run below commands in your terminal:
```
cd /var/www/
sudo -u www-data -s
cd /var/www/html
git fetch origin
git checkout origin/stable2
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

### How to setup a Raspberry Pi as an acess point?

```python
sudo apt install dnsmasq hostapd
```
Edit /etc/dhcpcd.conf
```python
sudo nano /etc/dhcpcd.conf
```
Add to the end of the file
```python
interface wlan0
    static ip_address=192.168.4.1/24
    nohook wpa_supplicant
```
restart dhcpcd
```python
sudo systemctl restart dhcpcd
```

#### Configuring the DHCP server
```python
sudo mv /etc/dnsmasq.conf /etc/dnsmasq.conf.orig
sudo nano /etc/dnsmasq.conf
```
Add the following
```python
interface=wlan0      # Use the require wireless interface - usually wlan0
dhcp-range=192.168.4.2,192.168.4.200,255.255.255.0,24h
```
Reload dnsmasq
```python
sudo systemctl reload dnsmasq
```

#### Configuring the access point host software (hostapd)
```python
sudo nano /etc/hostapd/hostapd.conf
```
Add the following
```python
interface=wlan0
driver=nl80211
ssid=photobooth
hw_mode=g
channel=7
wmm_enabled=0
macaddr_acl=0
auth_algs=1
ignore_broadcast_ssid=0
wpa=2
wpa_passphrase=photobooth
wpa_key_mgmt=WPA-PSK
wpa_pairwise=TKIP
rsn_pairwise=CCMP
```
Make sure config gets loaded
```python
sudo nano /etc/default/hostapd
```
Uncommend and update DAEMON_CONF
```python
DAEMON_CONF="/etc/hostapd/hostapd.conf"
```
Now enable and start hostapd
```python
sudo systemctl unmask hostapd
sudo systemctl enable hostapd
sudo systemctl start hostapd
```
Edit /etc/sysctl.conf 
```python
sudo nano /etc/sysctl.conf
```
and uncomment this line:
```python
net.ipv4.ip_forward=1
```
Reboot once
```python
sudo reboot
```
Add a masquerade for outbound traffic on eth0:
```python
sudo iptables -t nat -A  POSTROUTING -o eth0 -j MASQUERADE
```
Save the iptables rule.
```python
sudo sh -c "iptables-save > /etc/iptables.ipv4.nat"
```
Edit /etc/rc.local 
```python
sudo nano /etc/rc.local
```
and add this just above "exit 0" to install these rules on boot.
```python
iptables-restore < /etc/iptables.ipv4.nat
```
Source: https://www.raspberrypi.org/documentation/configuration/wireless/access-point.md


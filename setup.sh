#!/bin/bash

#check if root/sudo user
if [[ $EUID -ne 0 ]]; then
  echo "You must be a root user"
  echo "Trying to restart script as sudo"
  sudo $0 $@
  exit
fi

echo "Setup for Raspberry Pi"

apt-get update &&
apt-get upgrade -y &&
apt-get install php5 libapache2-mod-php5 apache2 git-core vim -y

mkdir -p /home/pi/www
ln -s /home/pi/www /var/www/pi

#install wiringPi
git clone git://git.drogon.net/wiringPi
cd wiringPi
./build

#get RFoutlet Code
cd /home/pi/www
git clone https://github.com/metalx1000/Zap-433mhz-RF-Pi-Controler.git
mv Zap-433mhz-RF-Pi-Controler outlet
cd outlet

echo "Starting RFSniffer..."
echo "press buttons on remote"
echo "Write this info down"
echo "<Enter> when done"
./RFSniffer &
read
killall RFSniffer

echo "change mySwitch.setPulseLength(xxx);"
echo "to match your pulse recorded in last step"
echo "(Enter to Continue)"
read
vim RFSource/codesend.cpp

cd RFSource
make codesend
mv -f codesend ../
cd ../
chown root.root codesend
chmod 4755 codesend

echo "now replace code for each button"
echo "(Enter to Continue)"
read
vim toggle.php

ip="$(ifconfig|grep eth0 -A 1|cut -d\: -f2|tail -n1|awk '{print $1}')"
echo "Now go to http://$ip/pi/outlet"


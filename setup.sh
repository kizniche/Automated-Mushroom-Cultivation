#!/bin/bash
#
# Mycodo install script
#
# Usage: sudo ./setup.sh
#

if [ "$EUID" -ne 0 ]; then
    printf "Please run as root with \"sudo ./setup.sh\"\n";
    exit
fi

INSTALL_DIRECTORY=$( cd "$( dirname "${BASH_SOURCE[0]}" )/" && pwd -P )
cd ${INSTALL_DIRECTORY}

LOG_LOCATION=${INSTALL_DIRECTORY}/setup.log
exec > >(tee -i ${LOG_LOCATION})
exec 2>&1

abort()
{
    echo >&2 '
*******************************
*** ERROR: Install Aborted! ***
*******************************

An error occurred that prevented Mycodo from being installed!

Please contact the developer by submitting a bug report at
https://github.com/kizniche/Mycodo/issues with the pertinent
excerpts from the setup log located at Mycodo/setup.log
'
    echo "An error occurred. Exiting..." >&2
    exit 1
}

trap 'abort' 0

set -e

NOW=$(date +"%m-%d-%Y %H:%M:%S")
printf "### Mycodo installation beginning at $NOW\n\n"

printf "#### Uninstalling current version of pip\n"
apt-get purge -y python-pip

printf "#### Installing and updating prerequisites\n"
apt-get update -y
apt-get upgrade -y
apt-get install -y libav-tools libffi-dev libi2c-dev python-dev python-setuptools python-smbus sqlite3
easy_install pip
pip install -U pip

wget --quiet --show-progress -P ${INSTALL_DIRECTORY}/ abyz.co.uk/rpi/pigpio/pigpio.zip
unzip pigpio.zip
cd ${INSTALL_DIRECTORY}/PIGPIO
make -j4
make install

git clone git://git.drogon.net/wiringPi ${INSTALL_DIRECTORY}/wiringPi
cd ${INSTALL_DIRECTORY}/wiringPi
./build

wget --quiet --show-progress -P ${INSTALL_DIRECTORY}/ https://dl.influxdata.com/influxdb/releases/influxdb_1.0.2_armhf.deb
dpkg -i ${INSTALL_DIRECTORY}/influxdb_1.0.2_armhf.deb
service influxdb start

cd ${INSTALL_DIRECTORY}
pip install -r requirements.txt --upgrade

rm -rf ./PIGPIO ./pigpio.zip ./wiringPi ./influxdb_0.13.0_armhf.deb

printf "#### Creating InfluxDB database and user\n"
influx -execute "CREATE DATABASE mycodo_db"
influx -database mycodo_db -execute "CREATE USER mycodo WITH PASSWORD 'mmdu77sj3nIoiajjs'"

printf "#### Creating cron entry to start pigpiod at boot\n"
${INSTALL_DIRECTORY}/mycodo/scripts/crontab.sh mycodo

printf "#### Installing and configuring apache2 web server\n"
apt-get install -y apache2 libapache2-mod-wsgi
a2enmod wsgi ssl

# original version #
# ln -sf ${INSTALL_DIRECTORY}/mycodo_flask_apache.conf /etc/apache2/sites-enabled/000-default.conf
#########"
# Myke974 modified # To avoid replacing the configuration 000-default.conf of the apache server in case someone already set his.
a2ensite ${INSTALL_DIRECTORY}/mycodo_flask_apache.conf
#######

printf "#### Creating SSL certificates at $INSTALL_DIRECTORY/mycodo/mycodo_flask/ssl_certs (replace with your own if desired)\n"
mkdir -p ${INSTALL_DIRECTORY}/mycodo/mycodo_flask/ssl_certs
cd ${INSTALL_DIRECTORY}/mycodo/mycodo_flask/ssl_certs/

openssl req \
    -new \
    -x509 \
    -sha512 \
    -days 365 \
    -nodes \
    -out cert.pem \
    -keyout privkey.pem\
    -subj "/C=US/ST=Georgia/L=Atlanta/O=mycodo/OU=mycodo/CN=mycodo"

openssl genrsa -out certificate.key 1024

openssl req \
    -new \
    -key certificate.key \
    -out certificate.csr \
    -subj "/C=US/ST=Georgia/L=Atlanta/O=mycodo/OU=mycodo/CN=mycodo"

openssl x509 -req \
    -days 365 \
    -in certificate.csr -CA cert.pem \
    -CAkey privkey.pem \
    -set_serial $RANDOM \
    -out chain.pem

rm -f certificate.csr

printf "#### Enabling mycodo startup script\n"
systemctl enable ${INSTALL_DIRECTORY}/mycodo/scripts/mycodo.service

printf "#### Creating SQLite databases\n"
${INSTALL_DIRECTORY}/init_databases.py -i all

printf "#### Setting up users, groups, and permissions\n"
${INSTALL_DIRECTORY}/mycodo/scripts/update_mycodo.sh initialize

printf "#### Starting the Mycodo daemon and web server\n"
service mycodo start
/etc/init.d/apache2 restart

trap : 0

IP=$(ip addr | grep 'state UP' -A2 | tail -n1 | awk '{print $2}' | cut -f1  -d'/')

if [[ -z ${IP} ]]; then
  IP="your.IP.here"
fi

echo >&2 "
***************************************************
** Mycodo successfully installed without errors! **
***************************************************

Go to https://${IP}/, or whatever your Pi's
IP address is, to create an admin user and log in.
"

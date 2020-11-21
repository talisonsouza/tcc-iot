https://pimylifeup.com/raspberry-pi-mysql/

https://www.raspberrypi.org/documentation/remote-access/web-server/apache.md

https://linuxize.com/post/how-to-install-git-on-raspberry-pi/

https://tecnoblog.net/282980/como-acessar-o-raspberry-pi-remotamente/

======= APACHE E PHP================================
sudo apt update

sudo apt install apache2 -y

sudo apt install php libapache2-mod-php -y

======= APACHE E PHP================================

======= GIT ==========

sudo apt install git

======= GIT ==========

========MYSQL======================================

sudo apt update
sudo apt upgrade

sudo apt install mariadb-server

sudo mysql_secure_installation

sudo mysql -u root -p

CREATE DATABASE tcc;

CREATE USER 'tcc_user'@'localhost' IDENTIFIED BY 'omega123';

GRANT ALL PRIVILEGES ON tcc.* TO 'tcc_user'@'localhost';

FLUSH PRIVILEGES;

sudo apt install php-mysql

sudo service apache2 restart

=========permission site====================

https://www.raspberrypi.org/forums/viewtopic.php?t=190513
$ sudo usermod -a -G gpio www-data
$ sudo groups www-data
$ sudo service apache2 restart

=========permission site====================



========MYSQL======================================

======== expor localhost na internet de graça para testes ========
https://dev.to/giorgosk/expose-your-local-web-server-to-the-world-using-localhost-run-or-serveo-net-l83
https://dashboard.ngrok.com/get-started/tutorials
ngrok http http://192.168.0.15:80
======== expor localhost na internet de graça para testes ========


CREATE TABLE device(
    id_device INT NOT NULL AUTO_INCREMENT,
    nm_device VARCHAR(100),
    ds_estado_device VARCHAR(40),
    ds_pino VARCHAR(40),
    ds_bit VARCHAR(40),
    PRIMARY KEY ( id_device )
  );

insert into device (nm_device,ds_estado_device,ds_pino,ds_bit)
values('Sala','0',7,'0');

insert into device (nm_device,ds_estado_device,ds_pino,ds_bit)
values('Quarto','0',11,'0');

insert into device (nm_device,ds_estado_device,ds_pino,ds_bit)
values('Quintal','0',12,'0');



insert into device (nm_device,ds_estado_device,ds_pino,ds_bit)
values('Ventilador','0',6,'0');



CREATE TABLE Config(
    id_config INT NOT NULL AUTO_INCREMENT,
    id_device INT,
    dv_acao VARCHAR(40),
    dt_config DATETIME,
    PRIMARY KEY ( id_config )
  );
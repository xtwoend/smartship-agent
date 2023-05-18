CREATE USER 'smartship'@'%' IDENTIFIED WITH mysql_native_password BY 'smartship123';
GRANT ALL PRIVILEGES ON *.* TO 'smartship'@'%';
FLUSH PRIVILEGES;
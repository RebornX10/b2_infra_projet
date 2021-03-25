#!/bin/bash

# Firewall : adding port 1337/tcp and udp
systemctl start firewalld
setenforce 0
firewall-cmd --add-port=1337/tcp --permanent
firewall-cmd --add-port=22/tcp --permamanent
firewall-cmd --add-port=22/udp --permanent
firewall-cmd --add-port=1337/udp --permanent
firewall-cmd --reload

# install vim
sudo yum install vim -y
sudo yum install wget -y 

# downloads the server's JAR
wget https://launcher.mojang.com/v1/objects/1b557e7b033b583cd9f66746b7a9ab1ec1673ced/server.jar
mkdir /home/vagrant/server
mv server.jar /home/vagrant/server
chown server /home/vagrant/server/server.jar
chmod +x /home/vagrant/server/server.jar

# disabling SELinux
setenforce 0

# making the launching script:
touch /home/vagrant/start.sh
cat > /home/vagrant/start.sh <<EOF
#!/bin/bash

java -jar /home/vagrant/server/server.jar -Xms512mb -Xmx1gb
EOF
su - server
chown -R :server /home/server/start.sh
chmod -R g+wrx /home/server/start.ssh

# Grafana installation
sudo ARCH=amd64 GCLOUD_STACK_ID="184246" GCLOUD_API_KEY="eyJrIjoiZTFhMzJhZDkwYmUwZTg5YTkwNTgwMjNhNjIwNGFlZmZhNjY3MjM0YSIsIm4iOiJiZHhnYW5nLWVhc3lzdGFydC1wcm9tLXB1Ymxpc2hlciIsImlkIjo0NzYzMzd9" /bin/sh -c "$(curl -fsSL https://raw.githubusercontent.com/grafana/agent/release/production/grafanacloud-install.sh)"

sudo systemctl restart grafana-agent.service

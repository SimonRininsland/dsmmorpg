echo Exit the container while leaving it running by pressing ctrl + p then ctrl + q.
docker pull linode/lamp
docker run -p 80:80 -t -i linode/lamp /bin/bash
service apache2 start
service mysql start
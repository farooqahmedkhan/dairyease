#/bin/bash

# Stop container
sudo docker-compose down
sudo docker stop dairyease_app_1
# sudo docker stop dairyease_mailhog_1
sudo docker stop dairyease_redis_1
# sudo docker stop dairyease_mysql_1

# Remove constainer
sudo docker rm dairyease_app_1
# sudo docker rm dairyease_mailhog_1
sudo docker rm dairyease_redis_1
# sudo docker rm dairyease_mysql_1

# Remove built image
sudo docker image rm dairyease-app

# Start containers
sudo docker-compose -f docker-compose.yml up --build --remove-orphans
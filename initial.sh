#!/bin/bash

docker exec owaspthattacker_web_1 a2enmod rewrite
docker restart owaspthattacker_web_1 

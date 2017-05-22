#!/bin/bash
pass="MySQL_P@ssw0rd"
mysql -u root -p"$pass" team1 < data.sql

#!bin/sh

if [ -z "$host" ]; then
        echo "host is empty"
else
        echo "host is $host"
fi

if [ -z "$port" ]; then
        echo "port is empty"
else
        echo "port is $port"
fi

cd ./airmuzik-test
./vendor/bin/phpunit --log-json ./report/report.json ./airmuziktest.php --host_ip_user $host --host_port_user $port


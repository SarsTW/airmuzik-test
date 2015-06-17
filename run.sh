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
./phpunit-selenium/vendor/bin/phpunit --log-json ./report/report.json PHPUNIT ./airmuziktest.php host $host port $port


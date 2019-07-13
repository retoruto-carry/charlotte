SCRIPT_DIR=$(cd $(dirname $0); pwd)

cd $SCRIPT_DIR

cp -f conf/.laradock-env ../laradock/.env
cp -f conf/createdb.sql ../laradock/mysql/docker-entrypoint-initdb.d/createdb.sql

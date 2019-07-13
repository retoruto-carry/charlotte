SCRIPT_DIR=$(cd $(dirname $0); pwd)

cd $SCRIPT_DIR

cp -f conf/.laravel-env ../.env

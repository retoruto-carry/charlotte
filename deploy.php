<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'charlotte');

// Project repository
set('repository', 'git@github.com:retoruto-carry/charlotte.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['.env']);
add('shared_dirs', ['storage']);

// Writable dirs by web server
add('writable_dirs', ['bootstrap/cache', 'storage']);

// Hosts

host('production')
    ->hostname('192.168.0.200')
    ->stage('production')
    ->user('pi')
    ->identityFile('~/.ssh/charlotte')
    ->forwardAgent()
    ->set('deploy_path', '/var/www/charlotte/production');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

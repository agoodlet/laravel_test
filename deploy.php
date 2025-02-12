<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:agoodlet/laravel_test.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('103.42.111.53')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/api');

// Hooks

after('deploy:failed', 'deploy:unlock');

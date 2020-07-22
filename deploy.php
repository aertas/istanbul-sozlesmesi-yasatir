<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/rsync.php';

set('application', 'istanbul-sozlesmesi-yasatir');
set('ssh_multiplexing', true);
set('keep_releases', 1);

set('rsync_src', function () {
	return __DIR__;
});

add('rsync', [
	'exclude' => [
		'.git',
		'/.env',
		'/storage/',
		'/vendor/',
		'/node_modules/',
		'.github',
		'deploy.php',
		'deployer.phar',
	],
]);

task('deploy:secrets', function () {
	file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
	upload('.env', get('deploy_path') . '/shared');
});

host('isy.concof.com')
	->hostname('104.248.170.149')
	->stage('production')
	->user('root')
	->set('deploy_path', '/home/isycncf');

after('deploy:failed', 'deploy:unlock');

desc('Deploy the application');
task('deploy', [
	'deploy:info',
	'deploy:prepare',
	'deploy:lock',
	'deploy:release',
	'rsync',
	'deploy:secrets',
	'deploy:shared',
	'deploy:vendors',
	'deploy:writable',
	'artisan:storage:link',
	'artisan:view:cache',
	'artisan:config:cache',
	'artisan:migrate',
	'artisan:queue:restart',
	'deploy:symlink',
	'deploy:unlock',
	'cleanup',
]);

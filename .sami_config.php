<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in('src')
;

return new Sami($iterator, array(
    'title'                => 'PHP Swiss Cantons',
    'build_dir'            => __DIR__.'/docs',
    'cache_dir'            => __DIR__.'/cache',
    'remote_repository'    => new GitHubRemoteRepository('stefanzweifel/php-swiss-cantons', dirname('src')),
    'default_opened_level' => 2,
));
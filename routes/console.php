<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('storage:mirror {--fresh : Delete and recreate public/storage before copy}', function () {
    $src = storage_path('app/public');
    $dest = public_path('storage');

    if (! File::isDirectory($src)) {
        $this->error('Source does not exist: '.$src);
        return 1;
    }

    if ($this->option('fresh') && File::isDirectory($dest)) {
        File::deleteDirectory($dest);
    }

    File::ensureDirectoryExists($dest);

    $success = File::copyDirectory($src, $dest);

    if (! $success) {
        $this->error('Copy failed. Please check permissions on: '.$dest);
        return 1;
    }

    $count = iterator_count(File::allFiles($src));
    $this->info("Mirrored $count files from $src to $dest");
    $this->comment('Use this when symlink is unavailable on hosting.');
    return 0;
})->purpose('Copy storage/app/public to public/storage when symlink is disabled');

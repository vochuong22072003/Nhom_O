<?php

namespace App\Console\Commands;

// use File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:avatar-link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link for storage to public for file upload of customers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $source = Storage::disk('upload')->path('avatars');
        $link = public_path('client/images/upload/avatars');

        if (file_exists($link)) {
            $this->error("The {$link} link already exists.");
        } else {
            
            // if (!File::exists($source . '/.gitignore')){
            //     File::put($source . '/.gitignore', "*\n");
            // }
            File::link($source, $link);
            $this->info("The {$source} link has been connected to {$link}.");
        }
    }
}

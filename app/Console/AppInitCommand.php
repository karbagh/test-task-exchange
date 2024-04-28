<?php

namespace App\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Этот процесс установит все зависимости, структуру базы данных и бэкенд приложения.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $progressBar = $this->output->createProgressBar(100);
        $progressBar->setMessage('Установка...');
        $progressBar->start();
        try {
            Artisan::call('storage:link');
            $progressBar->advance(10);

            Artisan::call('key:generate');
            $progressBar->advance(10);

            Artisan::call('migrate:fresh');
            $progressBar->setMessage('Таблицы созданы успешно.');
            $progressBar->advance(40);

            Artisan::call('passport:install');
            $progressBar->advance(20);

            Artisan::call('db:seed');
            $progressBar->advance(10);

            Artisan::call('optimize:clear');
            $progressBar->advance(5);

            Artisan::call('l5-swagger:generate');
            $progressBar->advance(15);

            $progressBar->setMessage('Установка приложения завершена успешно.');
            $progressBar->finish();

            return 0;
        } catch (Exception $e) {
            $this->error("Установка приложения провалена с кодом ошибки: {$e->getCode()}, причина: {$e->getMessage()}");
        }

        return 1;
    }
}


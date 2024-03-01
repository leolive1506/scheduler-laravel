# Scheduler
- Rodar localmente
  - em prod, usar **crontab** (sistema de agendamento do linux)
```sh
php artisan schedule:work
```

# Criar comando por meio de uma classe com metodo __invoce
```php
class DeleteOldLogs
{
  public function __invoke()
  {
    info('deleted');
  }
}

// kernel.php
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(new DeleteOldLogs())->everyMinute();
        // $schedule->command('inspire')->hourly();
    }
```

# Criar comando
```sh
php artisan make:command StartDevelopment
```

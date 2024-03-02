# Scheduler
- Rodar localmente
  - em prod, usar **Cron** (sistema de agendamento do linux)
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

- com job joga pra fila e libera o schedule de ficar processando o comando
    - é possivel liberar os proximos comando usando ->runInBackground()
    - **importante não travar os próximos comando para rodar no minuto certo**
```php

// kernel.php
protected function schedule(Schedule $schedule): void
{
    $schedule->call(new DeleteOldLogs())->everyMinute();
    $schedule->command('dev')->everyMinute();
    $schedule->job(new MyFirstJob())->everyMinute();
}
```

# Cron
- testar cron no site [crontab.guru](https://crontab.guru/)
```sh
crontab -e
```
- no cron do servidor basta [colocar o comando run](https://laravel.com/docs/10.x/scheduling#running-the-scheduler)
```sh
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

# Dicas
- não deixar um comando rodar se ja estiver sendo executado (->withoutOverlapping)

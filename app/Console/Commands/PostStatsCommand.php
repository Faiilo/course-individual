<?php
// artisan command: php artisan app:post-stats

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PostStatsCommand extends Command
{
    protected $signature = 'app:post-stats
                            {--start= : Начальная дата (YYYY-MM-DD)}
                            {--end= : Конечная дата (YYYY-MM-DD)}';

    protected $description = 'Подсчёт количества постов за период (бесплатные новости, платные новости, редакции)';

    public function handle()
    {
        $start = $this->option('start');
        $end = $this->option('end');

        if (!$start) {
            $start = $this->ask('Введите начальную дату (YYYY-MM-DD)');
        }
        if (!$end) {
            $end = $this->ask('Введите конечную дату (YYYY-MM-DD)');
        }

        $results = DB::select("
            SELECT 
                'Бесплатные новости' AS type,
                COUNT(*) AS total
            FROM posts
            WHERE post_type = 'news' AND is_paid = 0
              AND DATE(created_at) BETWEEN ? AND ?

            UNION ALL

            SELECT 
                'Платные новости' AS type,
                COUNT(*) AS total
            FROM posts
            WHERE post_type = 'news' AND is_paid = 1
              AND DATE(created_at) BETWEEN ? AND ?

            UNION ALL

            SELECT 
                'Редакции' AS type,
                COUNT(*) AS total
            FROM posts
            WHERE post_type = 'editorial'
              AND DATE(created_at) BETWEEN ? AND ?
        ", [$start, $end, $start, $end, $start, $end]);

        $this->newLine();
        $this->info("📊 Статистика за период: {$start} – {$end}");
        $this->newLine();

        foreach ($results as $row) {
            $this->line("• {$row->type}: {$row->total}");
        }

        $this->newLine();
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenUserGptKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:gen-user-gpt-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成用户鉴权key';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $startAt = now();
        $endAt = now()->addDays(7);
        $data = [];
        for ($i = 1;$i<=50;$i++){
            $data[]=[
                'key'=>'wo-'.md5(\Str::random(42).time()),
                'start_at'=>$startAt,
                'end_at'=>$endAt,
            ];
        }
        \DB::table('user_gpt_keys')->insert($data);
        $this->info('gen success');
    }
}

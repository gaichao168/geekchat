<?php

namespace App\Console\Commands;

use App\Models\UserGptKey;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Overtrue\LaravelWeChat\EasyWeChat;

class UpdateUserKeyDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-key-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //根据用户id更新
        $keys = [
            'wo-a61c10d6f2098c7c6c62ec00b675d212' => 12,
            'wo-76b860cc14b177d94bd0fb1f43844d55' => 1,
            'wo-907f19876609eba236ed6ac91d67e879' => 3,
            'wo-f6e4e5341f3f210381588708272d58e8' => 3,
            'wo-8431e8f0c41c7e08e5728736ef4d4cf3' => 3,
            'wo-52a2f1a0e83d867288f11784a4713bc9' => 1,
            'wo-73105a68e6fa2b1ca1cbecfadccdc30c' => 6,
            'wo-d425fd1e0446bd3c4c5dca5f8450750f' => 1,
            'wo-c0bb94b3ff102d107aa6ea90a85b393e' => 6,
            'wo-f9d6dcfece6e87d24f7d0130a799c92b' => 3,
            'wo-ef8b352e285f9fcead2c1c613d6c4841' => 12,
            'wo-dac3cb24cf8926aa3205b48f40a8a29d' => 3,
            'wo-67fcc17c8f770d544908e6f4f3abd6e1' => 1,
            'wo-da3dc29e3dad7b835b3b6eca5c21e6f0' => 6,
            'wo-b2720f3580e2c5cacb80b56cad0e7646' => 3,
            'wo-e88d9731cda17f1c91edb823b94651ce' => 6,
            'wo-a96abb055010a3e5dd799084134aaf52' => 1,
            'wo-f04bc949ff1868911609c8ffb8064e48' => 1,
            'wo-9971408e0659f9062dfcf7d6f0e754d2' => 6,
            'wo-0ef5d6aaac379682afc23b8e79871208' => 6,
        ];
        foreach ($keys as $k => $v) {
            $userkey = UserGptKey::where('key', $k)->first();
            if (empty($userkey)) {
                $this->error(sprintf('key not:%s', $k));
            } else {
                $userkey->update(
                    ['end_at' => Carbon::parse($userkey->end_at)->addMonths($v)]
                );
                $this->info(sprintf('%s:成功', $k));
            }
        }

        $ids = [
            1448 => 6,
            81 => 6,
            251 => 1,
            143 => 3,
            908 => 1,
            69 => 3,
            806 => 12,
            1010 => 1,
            2156 => 1,
            2289 => 3,
            647 => 12,
            651 => 1,
            2138 => 1,
            1472 => 1,
            890 => 1,
            459 => 1,
            2288 => 12,
        ];
        //根据用户ids更新
        foreach ($ids as $id => $v) {
            $userkey = UserGptKey::where('wechat_id', $id)->first();
            if (empty($userkey)) {
                $this->error(sprintf('id not:%s', $id));
            } else {
                $userkey->update(
                    ['end_at' => Carbon::parse($userkey->end_at)->addMonths($v)]
                );
                $this->info(sprintf('%s:成功', $id));
            }
        }
    }
}

<?php

namespace App\Console\Commands;

use EasyWeChat\Kernel\Form\File;
use EasyWeChat\Kernel\Form\Form;
use Illuminate\Console\Command;
use Overtrue\LaravelWeChat\EasyWeChat;

class UploadWechatImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upload-wechat-image';

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
        $easyWeChat = EasyWeChat::officialAccount();


        $options = Form::create(
            [
                'media' => File::fromPath(public_path('images/wechat_group.jpg')),
            ]
        )->toArray();

        $response = $easyWeChat->getClient()->post('cgi-bin/media/upload?type=image', $options);
        $data = json_decode($response->getContent(),true);
        $this->info('中转群是：'.$data['media_id']);
        $options = Form::create(
            [
                'media' => File::fromPath(public_path('images/wechat_code.jpg')),
            ]
        )->toArray();

        $response = $easyWeChat->getClient()->post('cgi-bin/media/upload?type=image', $options);
        $data = json_decode($response->getContent(),true);
        $this->info('个人微信是：'.$data['media_id']);

    }
}

<?php

namespace Database\Seeders;

use App\Models\UserGptKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WechatUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\WechatUser::factory(50)->has(UserGptKey::factory()->count(1))->create();
    }
}

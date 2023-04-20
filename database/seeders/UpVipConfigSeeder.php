<?php

namespace Database\Seeders;

use App\Models\Admin\UpVipConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpVipConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentAt = now();
        UpVipConfig::query()->insert(
            [
                [
                    'id' => 1,
                    'title' => '天',
                    'type' => 1,
                    'created_at' => $currentAt,
                    'updated_at' => $currentAt,
                ],
                [
                    'id' => 2,
                    'title' => '周',
                    'type' => 2,
                    'created_at' => $currentAt,
                    'updated_at' => $currentAt,
                ],
                [
                    'id' => 3,
                    'title' => '月',
                    'type' => 3,
                    'created_at' => $currentAt,
                    'updated_at' => $currentAt,
                ],
                [
                    'id' => 4,
                    'title' => '季',
                    'type' => 4,
                    'created_at' => $currentAt,
                    'updated_at' => $currentAt,
                ],
                [
                    'id' => 5,
                    'title' => '半年',
                    'type' => 5,
                    'created_at' => $currentAt,
                    'updated_at' => $currentAt,
                ],
                [
                    'id' => 6,
                    'title' => '全年',
                    'type' => 6,
                    'created_at' => $currentAt,
                    'updated_at' => $currentAt,
                ],
                [
                    'id' => 7,
                    'title' => '终身',
                    'type' => 7,
                    'created_at' => $currentAt,
                    'updated_at' => $currentAt,
                ],
            ]
        );
    }
}

<?php
declare(strict_types=1);

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UpVipConfig extends AdminBaseModel
{
    protected $table = "up_vip_config";

    protected $fillable = [
        'type', 'title'
    ];

    public static function getConfig(): array
    {
        $items = self::query()
            ->get(["id", "title"]);
        $array = [];
        foreach ($items as $value) {
            $array[$value->id] = $value->title;
        }
        return $array;
    }
}

<?php
declare(strict_types=1);

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WeChat extends AdminBaseModel
{
    protected $table = "wechat_users";

    public function key(): HasOne
    {
        return $this->hasOne(UserGptKeys::class, "wechat_id", "id");
    }

    public function history(): HasMany
    {
        return $this->hasMany(UpVipHistory::class, "wechat_id", "id");
    }
}

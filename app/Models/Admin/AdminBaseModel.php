<?php
declare(strict_types=1);

namespace App\Models\Admin;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class AdminBaseModel extends Model
{
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}

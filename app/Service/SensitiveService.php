<?php

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use nickbai\sensitive\SensitiveWords;
use nickbai\sensitive\Tree;
use nickbai\sensitive\Utils;

class SensitiveService
{
    private $tree;

    private string $sensitiveKey = 'sensitive:key';

public function __construct()
{
    $this->iniKeywords();
}

    protected function iniKeywords(): void
    {
        if (Cache::has($this->sensitiveKey)) {
            $this->tree = Cache::get($this->sensitiveKey);
        } else {
            $keywords = config('sensitive');
            $nodes = Utils::words2Node($keywords);
            $tree = new  Tree($nodes);
            Cache::set($this->sensitiveKey, $tree);
            $this->tree = $tree;
        }
    }

    public function filter(string $text, string $placeholder = "**"): string
    {
        $this->iniKeywords();
        $sensitive = new SensitiveWords($this->tree);
        return $sensitive->filter($text, $placeholder);
    }

    public function has(string $text): bool|array
    {
        $sensitive = new SensitiveWords($this->tree);
        return $sensitive->has($text);
    }
}

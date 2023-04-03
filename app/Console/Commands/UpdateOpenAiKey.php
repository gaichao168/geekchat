<?php

namespace App\Console\Commands;

use App\Models\OpenAiKey;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateOpenAiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-open-ai-key';

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
        $this->info('Updating OpenAI key...');
        $apiKey = config('openai.api_key');
        $response = Http::withToken($apiKey)->timeout(15)
            ->get(config('openai.base_uri') . '/dashboard/billing/credit_grants');
        $granted = $response->json('total_granted', 0.00);
        $used = $response->json('total_used', 0.00);
        $available = $response->json('total_available', 0.00);

        if ($available > 0) {
            $this->info('Current key is still valid.');
            return;
        }
        OpenAiKey::where('key', $apiKey)->update([
            'end_at' => now(),
            'total_granted' => $granted,
            'total_used' => $used,
            'total_available' => $available,
        ]);
        $new_key = OpenAiKey::query()->whereNull('end_at')->first()?->key;
        if (!$new_key) {
            Log::error('No more keys.');
            return;
        }

        $origin = file_get_contents(base_path('.env'));
        $apiKey = config('openai.api_key');
        $result = str_replace($apiKey, $new_key, $origin);
        file_put_contents(base_path('.env'), $result);
        $this->call('config:clear');
        $this->call('config:cache');
        $this->info('OpenAI key updated.');
    }
}

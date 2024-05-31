<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\IPTVChannel;

class SyncIPTVChannels extends Command
{
    protected $signature = 'iptv:sync-channels';

    protected $description = 'Sync IPTV channels from IPTV API';

    public function handle()
    {
        $response = Http::get('https://iptv-org.github.io/api/channels.json');

        $channels = $response->json();

        foreach ($channels as $channelData) {
            // Fetch M3U8 links for each channel
            $m3u8Links = $this->fetchM3U8Links($channelData['id']);

            IPTVChannel::updateOrCreate(
                ['channel_id' => $channelData['id']],
                [
                    'name' => $channelData['name'],
                    'alt_names' => $channelData['alt_names'] ?? [],
                    'network' => $channelData['network'] ?? null,
                    'owners' => $channelData['owners'] ?? [],
                    'country' => $channelData['country'],
                    'subdivision' => $channelData['subdivision'] ?? null,
                    'city' => $channelData['city'] ?? null,
                    'broadcast_area' => $channelData['broadcast_area'] ?? [],
                    'languages' => $channelData['languages'] ?? [],
                    'categories' => $channelData['categories'] ?? [],
                    'is_nsfw' => $channelData['is_nsfw'] ?? false,
                    'launched' => $channelData['launched'] ?? null,
                    'closed' => $channelData['closed'] ?? null,
                    'replaced_by' => $channelData['replaced_by'] ?? null,
                    'website' => $channelData['website'] ?? null,
                    'logo' => $channelData['logo'] ?? null,
                    'm3u8' => $m3u8Links, // Assign fetched M3U8 links
                ]
            );
        }

        $this->info('IPTV channels sync completed successfully.');
    }

    protected function fetchM3U8Links($channelId)
    {
        $response = Http::get("https://iptv-org.github.io/iptv/channel/{$channelId}.m3u");

        if ($response->ok()) {
            return $response->body();
        }

        return null;
    }
}

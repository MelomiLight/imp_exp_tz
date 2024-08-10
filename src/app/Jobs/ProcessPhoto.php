<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Upload;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessPhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $url;
    private int $productId;
    private string $type;

    /**
     * Create a new job instance.
     */
    public function __construct(string $url, int $productId, string $type)
    {
        $this->url = $url;
        $this->productId = $productId;
        $this->type = $type;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (filter_var($this->url, FILTER_VALIDATE_URL)) {
            try {
                $response = Http::get($this->url);

                if ($response->successful()) {
                    $fileContent = $response->body();
                    $fileName = basename($this->url);

                    Storage::disk('public')->put("uploads/{$fileName}", $fileContent);

                    $filePath = "uploads/{$fileName}";

                    Upload::create([
                        'uploadable_id' => $this->productId,
                        'uploadable_type' => Product::class,
                        'disk' => 'public',
                        'name' => $fileName,
                        'path' => '/storage/' . $filePath,
                        'size' => strlen($fileContent),
                        'hash' => sha1($fileContent),
                        'upload_type' => $this->type,
                    ]);
                } else {
                    Log::error("Failed to retrieve photo from URL {$this->url}");
                }
            } catch (Exception $e) {
                Log::error("Failed to process photo from URL {$this->url} for product ID {$this->productId}: " . $e->getMessage());
            }
        } else {
            Log::error("Invalid URL for product ID {$this->productId}: {$this->url}");
        }
    }

}

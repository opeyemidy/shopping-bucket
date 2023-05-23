<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\DB;

class ProcessDiscountsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The session data.
     *
     * @var array
     */
    protected $sessionData;

    /**
     * Create a new job instance.
     *
     * @param array $sessionData
     */
    public function __construct(array $sessionData)
    {
        $this->sessionData = $sessionData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->sessionData;

        $existingProductIds = DB::table('discounts')
            ->whereIn('product_id', $data)
            ->pluck('product_id')
            ->toArray();

        $updateData = [];
        $insertData = [];

        foreach ($data as $product_id) {
            if (in_array($product_id, $existingProductIds)) {
                $updateData[] = $product_id;
            } else {
                $insertData[] = [
                    'product_id' => $product_id,
                    'remove_count' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($updateData)) {
            DB::table('discounts')
                ->whereIn('product_id', $updateData)
                ->update([
                    'remove_count' => DB::raw('IFNULL(remove_count, 1) + 1'),
                    'updated_at' => now()
                ]);
        }

        if (!empty($insertData)) {
            DB::table('discounts')->insert($insertData);
        }
    
    }
}

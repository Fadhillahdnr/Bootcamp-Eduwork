<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductViewed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;
    public $total_clicks;

    public function __construct($product)
    {
        $this->product = $product;

        // Hitung total klik semua produk
        $this->total_clicks = Product::sum('click_count');
    }

    public function broadcastOn()
    {
        return new Channel('admin-dashboard');
    }

    public function broadcastAs()
    {
        return 'product.viewed';
    }
}

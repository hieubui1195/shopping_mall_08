<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderRejectItemMail;
use App\Models\OrderDetail;
use App\Models\Order;

class OrderRejectItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderDetailId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->orderDetailId = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = OrderDetail::where('id', $this->orderDetailId)->with('order')->get();
        $email = $order[0]['order']['email'];
        Mail::to($email)->send(new OrderRejectItemMail($this->orderDetailId));
    }
}

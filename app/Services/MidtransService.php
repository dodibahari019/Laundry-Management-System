<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction($order, $customerDetails)
    {
        try {
            // Validasi order items
            if (!$order->orderItems || $order->orderItems->isEmpty()) {
                throw new \Exception('Order items tidak ditemukan');
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $order->kode_order,
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => $customerDetails,
                'item_details' => $this->getItemDetails($order),
                'enabled_payments' => [
                    'credit_card', 
                    'bca_va', 
                    'bni_va', 
                    'bri_va', 
                    'mandiri_va', 
                    'permata_va', 
                    'gopay', 
                    'qris'
                ],
            ];

            Log::info('Midtrans params:', $params);

            $snapToken = Snap::getSnapToken($params);
            
            return [
                'success' => true,
                'snap_token' => $snapToken
            ];
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function getItemDetails($order)
    {
        $items = [];
        
        // PERBAIKAN: Gunakan orderItems bukan items
        foreach ($order->orderItems as $item) {
            // Validasi layanan relationship
            if (!$item->layanan) {
                throw new \Exception("Layanan tidak ditemukan untuk item {$item->id_order_item}");
            }
            
            $items[] = [
                'id' => $item->id_layanan,
                'price' => (int) $item->harga,
                'quantity' => (int) $item->qty,
                'name' => $item->layanan->nama_layanan
            ];
        }
        
        return $items;
    }

    public function getTransactionStatus($orderId)
    {
        try {
            $status = Transaction::status($orderId);
            return $status;
        } catch (\Exception $e) {
            Log::error('Get Transaction Status Error: ' . $e->getMessage());
            return null;
        }
    }
}
<?php
// File: app/Services/NotificationService.php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Create notification for new order
     */
    public static function newOrder($sellerId, $orderId, $customerName, $amount)
    {
        return Notification::create([
            'user_id' => $sellerId,
            'type' => Notification::TYPE_ORDER,
            'title' => 'Pesanan Baru #INV-' . str_pad($orderId, 6, '0', STR_PAD_LEFT),
            'message' => "Anda mendapat pesanan baru dari {$customerName} senilai Rp " . number_format($amount, 0, ',', '.'),
            'link' => route('pesanan.index'),
            'data' => json_encode([
                'order_id' => $orderId,
                'customer_name' => $customerName,
                'amount' => $amount
            ])
        ]);
    }

    /**
     * Create notification for order status change
     */
    public static function orderStatusChanged($userId, $orderId, $status)
    {
        $statusText = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'processing' => 'Sedang Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return Notification::create([
            'user_id' => $userId,
            'type' => Notification::TYPE_ORDER,
            'title' => 'Status Pesanan Berubah',
            'message' => "Pesanan #INV-{$orderId} status: {$statusText[$status]}",
            'link' => route('pesanan.index'),
            'data' => json_encode([
                'order_id' => $orderId,
                'status' => $status
            ])
        ]);
    }

    /**
     * Create notification for new review
     */
    public static function newReview($sellerId, $productName, $rating, $reviewerName)
    {
        return Notification::create([
            'user_id' => $sellerId,
            'type' => Notification::TYPE_REVIEW,
            'title' => 'Review Baru',
            'message' => "{$reviewerName} memberikan rating {$rating} bintang untuk produk \"{$productName}\"",
            'link' => route('produk.index'),
            'data' => json_encode([
                'product_name' => $productName,
                'rating' => $rating,
                'reviewer' => $reviewerName
            ])
        ]);
    }

    /**
     * Create notification for low stock
     */
    public static function lowStock($sellerId, $productName, $stock)
    {
        return Notification::create([
            'user_id' => $sellerId,
            'type' => Notification::TYPE_STOCK,
            'title' => 'Stok Rendah',
            'message' => "Produk \"{$productName}\" stok tersisa {$stock} unit",
            'link' => route('produk.index'),
            'data' => json_encode([
                'product_name' => $productName,
                'stock' => $stock
            ])
        ]);
    }

    /**
     * Create notification for sales milestone
     */
    public static function salesMilestone($sellerId, $milestone, $amount)
    {
        return Notification::create([
            'user_id' => $sellerId,
            'type' => Notification::TYPE_SALES,
            'title' => 'Target Tercapai! 🎉',
            'message' => "Selamat! Anda telah mencapai {$milestone} dengan total penjualan Rp " . number_format($amount, 0, ',', '.'),
            'link' => route('analytics.index'),
            'data' => json_encode([
                'milestone' => $milestone,
                'amount' => $amount
            ])
        ]);
    }

    /**
     * Create notification for new message
     */
    public static function newMessage($userId, $senderName, $message)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => Notification::TYPE_MESSAGE,
            'title' => 'Pesan Baru',
            'message' => "{$senderName}: " . substr($message, 0, 50) . (strlen($message) > 50 ? '...' : ''),
            'link' => '#', // Link ke chat page
            'data' => json_encode([
                'sender' => $senderName,
                'preview' => substr($message, 0, 100)
            ])
        ]);
    }

    /**
     * Create notification for promo/voucher
     */
    public static function promoNotification($userId, $promoTitle, $description, $expiryDays)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => Notification::TYPE_PROMO,
            'title' => $promoTitle,
            'message' => $description . ($expiryDays ? " (Berakhir dalam {$expiryDays} hari)" : ''),
            'link' => route('home'),
            'data' => json_encode([
                'promo_title' => $promoTitle,
                'expiry_days' => $expiryDays
            ])
        ]);
    }

    /**
     * Send notification to multiple users
     */
    public static function sendBulk($userIds, $type, $title, $message, $link = null)
    {
        $notifications = [];
        foreach ($userIds as $userId) {
            $notifications[] = [
                'user_id' => $userId,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'link' => $link,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        
        return Notification::insert($notifications);
    }
}
<?php

namespace App\Enums;

class BerkasAkhirMagangStatus 
{
    use EnumTrait;

    const PENDING = 'pending';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    
    public static function getWithLabel($status = null)
    {
        $data = [
            self::PENDING => ['title' => 'Pending', 'color' => 'warning'],
            self::APPROVED => ['title' => 'Approved', 'color' => 'success'],
            self::REJECTED => ['title' => 'Rejected', 'color' => 'danger']
        ];

        if ($status) return $data[$status];

        return $data;
    }
}
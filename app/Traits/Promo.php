<?php

namespace App\Traits;

use App\Models\Coupon;

trait Promo {
    public function getPromo($amount, $code, $academies) {
        $code= trim($code);

        if (!$code) {
            return [
                'amount' => $amount, 
                'status' => true
            ];
        }

        $coupon= Coupon::where('code', $code)->first();

        if (!$coupon) {
            return [
                'amount' => $amount, 
                'status' => false,
                'message' => 'Maaf, kode promomu salah atau sudah nggak berlaku nih :('
            ];
        }

        if ($coupon->type === 'simple') {   
            $amount-= $coupon->cut;

            return ['amount' => $amount, 'status' => true];
        } else if ($coupon->type === 'pahe') {
            if (count($academies) >= $coupon->extra_variable) {
                $amount-= $coupon->cut;

                return [
                    'amount' => $amount, 
                    'status' => true
                ];
            } else {
                return [
                    'amount' => $amount, 
                    'status' => false, 
                    'message' => $coupon->description 
                ];
            }
        }

        return [
            'amount' => $amount, 
            'status' => false,
            'message' => 'Maaf, kode promomu salah atau sudah nggak berlaku nih :('
        ];
    }
}
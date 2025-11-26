<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'registration_number',
        'barcode',
        'race_pack_picked_up',
        'race_pack_picked_up_at',
        'category',
        'category_type',
        'unique_price_code',
        'first_name',
        'last_name',
        'email',
        'bib_name',
        'phone',
        'birth_date',
        'gender',
        'occupation',
        'id_type',
        'id_number',
        'address',
        'city',
        'jersey_size',
        'blood_type',
        'emergency_name',
        'emergency_phone',
        'community',
        'medical_notes',
        'payment_proof_path',
        'payment_status',
        'status',
        'admin_notes',
        'approved_at',
        'rejected_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'race_pack_picked_up' => 'boolean',
        'race_pack_picked_up_at' => 'datetime',
    ];

    /**
     * Generate unique registration number with format SFR5001, SFR5002, etc.
     */
    public static function generateRegistrationNumber(): string
    {
        // Find the last registration number with format SFR5xxx
        $lastRegistration = self::where('registration_number', 'like', 'SFR5%')
            ->orderByRaw('CAST(SUBSTRING(registration_number, 4) AS UNSIGNED) DESC')
            ->first();

        if ($lastRegistration && preg_match('/SFR5(\d+)/', $lastRegistration->registration_number, $matches)) {
            // Increment the number
            $nextNumber = (int)$matches[1] + 1;
        } else {
            // Start from SFR5001 if no registration found
            $nextNumber = 1;
        }

        // Format: SFR5001, SFR5002, etc. (4 digits)
        $registrationNumber = 'SFR5' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Double check uniqueness (safety check)
        $counter = 0;
        while (self::where('registration_number', $registrationNumber)->exists() && $counter < 100) {
            $nextNumber++;
            $registrationNumber = 'SFR5' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            $counter++;
        }

        return $registrationNumber;
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Generate unique price code for category type
     * Satpam: starts from 170001, 170002, etc.
     * Umum: starts from 180001, 180002, etc.
     */
    public static function generateUniquePriceCode(string $categoryType): int
    {
        $basePrice = $categoryType === 'satpam' ? 170000 : 180000;
        
        // Find the last registration with this category type
        $lastRegistration = self::where('category_type', $categoryType)
            ->whereNotNull('unique_price_code')
            ->orderByDesc('unique_price_code')
            ->first();

        if ($lastRegistration && $lastRegistration->unique_price_code) {
            // Increment the code
            $nextCode = $lastRegistration->unique_price_code + 1;
        } else {
            // Start from base + 1
            $nextCode = $basePrice + 1;
        }

        return $nextCode;
    }

    /**
     * Get unique price (base price + unique code)
     */
    public function getUniquePriceAttribute(): int
    {
        if (!$this->unique_price_code) {
            return 0;
        }
        return $this->unique_price_code;
    }
}

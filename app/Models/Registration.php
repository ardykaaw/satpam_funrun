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
        'kta_number',
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
     * Generate unique registration number with format SFR - 0201, SFR - 0202, etc.
     */
    public static function generateRegistrationNumber(): string
    {
        // Find the last registration number with format SFR - XXXX or SFR5XXX (old format)
        $lastRegistration = self::where(function($query) {
                $query->where('registration_number', 'like', 'SFR - %')
                      ->orWhere('registration_number', 'like', 'SFR5%');
            })
            ->orderByDesc('id')
            ->first();

        $nextNumber = 201; // Start from 0201

        if ($lastRegistration) {
            // Try new format: SFR - 0201
            if (preg_match('/SFR\s*-\s*0?(\d+)/', $lastRegistration->registration_number, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            }
            // Try old format: SFR5001
            elseif (preg_match('/SFR5(\d+)/', $lastRegistration->registration_number, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
                // If old format was less than 201, start from 201
                if ($nextNumber < 201) {
                    $nextNumber = 201;
                }
            }
        }

        // Ensure minimum is 201
        if ($nextNumber < 201) {
            $nextNumber = 201;
        }

        // Format: SFR - 0201, SFR - 0202, etc. (4 digits with leading zero)
        $registrationNumber = 'SFR - ' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Double check uniqueness (safety check)
        $counter = 0;
        while (self::where('registration_number', $registrationNumber)->exists() && $counter < 100) {
            $nextNumber++;
            $registrationNumber = 'SFR - ' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
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
     * Generate unique price code with global counter starting from 401
     * Counter is shared between both categories (satpam and umum)
     * Counter continues regardless of category - truly global
     * Example: 180.401 (umum), 170.402 (satpam), 180.403 (umum), 170.404 (satpam)
     */
    public static function generateUniquePriceCode(string $categoryType): int
    {
        $basePrice = $categoryType === 'satpam' ? 170000 : 180000;
        
        // Find the last registration with unique_price_code (global counter - regardless of category)
        $lastRegistration = self::whereNotNull('unique_price_code')
            ->orderByDesc('unique_price_code')
            ->first();

        $nextCounter = 401; // Default start from 401
        
        if ($lastRegistration && $lastRegistration->unique_price_code) {
            // Extract the counter from the last price code (global counter)
            $lastCode = $lastRegistration->unique_price_code;
            
            // Determine which base price was used and extract counter
            if ($lastCode >= 180000) {
                // Last was umum (180xxx)
                $lastCounter = $lastCode - 180000;
            } else {
                // Last was satpam (170xxx)
                $lastCounter = $lastCode - 170000;
            }
            
            // Increment counter for next registration (global counter continues)
            $nextCounter = $lastCounter + 1;
        }

        // Ensure counter is at least 401
        if ($nextCounter < 401) {
            $nextCounter = 401;
        }

        // Calculate unique price: base price + counter
        $uniquePrice = $basePrice + $nextCounter;

        // Double check uniqueness (safety check)
        $counter = 0;
        while (self::where('unique_price_code', $uniquePrice)->exists() && $counter < 100) {
            $nextCounter++;
            $uniquePrice = $basePrice + $nextCounter;
            $counter++;
        }

        return $uniquePrice;
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

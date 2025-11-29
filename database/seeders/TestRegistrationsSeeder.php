<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestRegistrationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testEmail = 'ardykaaw26@gmail.com';
        
        // Sample data for testing
        $names = [
            ['first' => 'Ardy', 'last' => 'Kaaw'],
            ['first' => 'Budi', 'last' => 'Santoso'],
            ['first' => 'Siti', 'last' => 'Nurhaliza'],
            ['first' => 'Ahmad', 'last' => 'Fauzi'],
            ['first' => 'Dewi', 'last' => 'Lestari'],
            ['first' => 'Rudi', 'last' => 'Hartono'],
            ['first' => 'Maya', 'last' => 'Sari'],
            ['first' => 'Joko', 'last' => 'Widodo'],
            ['first' => 'Rina', 'last' => 'Wati'],
            ['first' => 'Agus', 'last' => 'Prasetyo'],
        ];
        
        $categories = [
            ['type' => 'satpam', 'name' => 'Satpam'],
            ['type' => 'umum', 'name' => 'Umum'],
            ['type' => 'satpam', 'name' => 'Satpam'],
            ['type' => 'umum', 'name' => 'Umum'],
            ['type' => 'umum', 'name' => 'Umum'],
            ['type' => 'satpam', 'name' => 'Satpam'],
            ['type' => 'umum', 'name' => 'Umum'],
            ['type' => 'satpam', 'name' => 'Satpam'],
            ['type' => 'umum', 'name' => 'Umum'],
            ['type' => 'satpam', 'name' => 'Satpam'],
        ];
        
        $jerseySizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $bloodTypes = ['A', 'B', 'AB', 'O'];
        $genders = ['Laki-laki', 'Perempuan'];
        $idTypes = ['KTP', 'SIM', 'Passport'];
        
        DB::transaction(function () use ($testEmail, $names, $categories, $jerseySizes, $bloodTypes, $genders, $idTypes) {
            for ($i = 0; $i < 10; $i++) {
                $name = $names[$i];
                $category = $categories[$i];
                $gender = $genders[$i % 2];
                $birthYear = 1990 + ($i % 20); // Age between 25-45
                
                // Generate unique price code
                $uniquePriceCode = Registration::generateUniquePriceCode($category['type']);
                
                Registration::create([
                    'category' => $category['name'],
                    'category_type' => $category['type'],
                    'unique_price_code' => $uniquePriceCode,
                    'first_name' => $name['first'],
                    'last_name' => $name['last'],
                    'email' => $testEmail,
                    'bib_name' => strtoupper(substr($name['first'], 0, 8)),
                    'phone' => '081234567' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'birth_date' => now()->subYears($birthYear - 1990)->format('Y-m-d'),
                    'gender' => $gender,
                    'occupation' => $category['type'] === 'umum' ? 'Karyawan Swasta' : 'Satpam',
                    'kta_number' => $category['type'] === 'satpam' ? 'KTA' . str_pad($i + 1000, 6, '0', STR_PAD_LEFT) : null,
                    'id_type' => $idTypes[$i % 3],
                    'id_number' => '320101' . str_pad($i, 10, '0', STR_PAD_LEFT),
                    'address' => 'Jl. Test No. ' . ($i + 1) . ', RT 001/RW 001',
                    'city' => 'Jakarta',
                    'jersey_size' => $jerseySizes[$i % 6],
                    'blood_type' => $bloodTypes[$i % 4],
                    'emergency_name' => 'Emergency Contact ' . ($i + 1),
                    'emergency_phone' => '081999888' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'community' => $i % 2 === 0 ? 'Komunitas Test' : null,
                    'medical_notes' => $i % 3 === 0 ? 'Tidak ada alergi' : null,
                    'payment_proof_path' => null,
                    'status' => 'pending',
                    'payment_status' => 'pending',
                ]);
            }
        });
        
        $this->command->info('✅ Created 10 test registrations with email: ' . $testEmail);
        $this->command->info('   Status: pending (ready to approve)');
        $this->command->info('   Mix: 5 Satpam, 5 Umum');
    }
}

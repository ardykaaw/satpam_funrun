<?php

namespace Database\Seeders;

use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RegistrationSeeder extends Seeder
{
    /**
     * Seed dummy registrations for admin screens.
     */
    public function run(): void
    {
        if (Registration::exists()) {
            // Avoid duplicating data on existing environments
            $this->command?->warn('Registrations table already contains data. Skipping dummy records.');
            return;
        }

        $faker = fake('id_ID');

        $categories = [
            '5K - Kategori Umum',
            '5K - Pelajar',
            '10K - Kategori Umum',
        ];

        $occupations = ['Mahasiswa', 'PNS', 'Karyawan Swasta', 'Wirausaha', 'Atlet'];
        $jerseySizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $bloodTypes = ['A', 'B', 'AB', 'O'];

        foreach (range(1, 50) as $index) {
            $gender = Arr::random(['Laki-laki', 'Perempuan']);
            $firstName = $gender === 'Laki-laki' ? $faker->firstNameMale() : $faker->firstNameFemale();
            $lastName = $faker->lastName();
            $status = Arr::random([
                'approved',
                'approved',
                'pending',
                'pending',
                'rejected',
            ]);

            $paymentStatus = match ($status) {
                'approved' => 'verified',
                'rejected' => 'rejected',
                default => 'pending',
            };

            $approvedAt = $status === 'approved'
                ? Carbon::now()->subDays(rand(1, 14))->setTime(rand(6, 21), rand(0, 59))
                : null;

            $rejectedAt = $status === 'rejected'
                ? Carbon::now()->subDays(rand(1, 21))->setTime(rand(6, 21), rand(0, 59))
                : null;

            $fullName = "{$firstName} {$lastName}";

            Registration::create([
                'registration_number' => $status === 'approved'
                    ? Registration::generateRegistrationNumber()
                    : null,
                'category' => Arr::random($categories),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $faker->unique()->safeEmail(),
                'bib_name' => Str::upper(Str::limit($fullName, 16, '')),
                'phone' => '08' . $faker->numerify('##########'),
                'birth_date' => Carbon::now()->subYears(rand(17, 45))->subDays(rand(0, 365)),
                'gender' => $gender,
                'occupation' => Arr::random($occupations),
                'id_type' => Arr::random(['KTP', 'SIM', 'Passport', 'Kartu Pelajar']),
                'id_number' => $faker->numerify('################'),
                'address' => $faker->streetAddress(),
                'city' => $faker->city(),
                'jersey_size' => Arr::random($jerseySizes),
                'blood_type' => Arr::random($bloodTypes),
                'emergency_name' => $faker->name(),
                'emergency_phone' => '08' . $faker->numerify('##########'),
                'community' => $faker->boolean(35) ? $faker->company() : null,
                'medical_notes' => $faker->boolean(20) ? $faker->sentence(8) : null,
                'payment_proof_path' => null,
                'payment_status' => $paymentStatus,
                'status' => $status,
                'admin_notes' => $status === 'approved'
                    ? 'Berkas dan pembayaran valid.'
                    : ($status === 'rejected' ? 'Bukti transfer tidak terbaca.' : null),
                'approved_at' => $approvedAt,
                'rejected_at' => $rejectedAt,
            ]);
        }
    }
}



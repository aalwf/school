<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // import trait dari Spatie

class User extends Authenticatable
{
    // Menggunakan HasRoles untuk menggunakan fitur Spatie
    use HasFactory, Notifiable, HasRoles;

    // Field yang boleh diisi
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Field yang tidak boleh diperlihatkan
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mengembalikan array yang mendefinisikan tipe data yang akan di-cast
     * pada atribut model.
     *
     * @return array
     */
    //
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Mengembalikan array yang berisi nama permission yang dimiliki oleh
     * user yang sedang login. Nama permission yang dikembalikan dalam bentuk
     * array yang memiliki key berupa nama permission dan value nya berupa boolean.
     *
     * @return array
     */
    public function getUserPermissions()
    {
        // Mengambil semua permission yang dimiliki oleh user
        return $this->getAllPermissions()->mapWithKeys(fn($permission) => [$permission['name'] => true]);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    // Mendefinisikan property
    public $status;
    public $message;
    public $resource;

    /**
     * Method untuk menginisialisasi property diatas dalam constructor yang akan dijalankan ketika class diinstansiasi
     * @param mixed $status
     * @param mixed $message
     * @param mixed $resource
     */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource); // Memanggil constructor parent
        $this->status  = $status; // Menginisialisasi property status
        $this->message = $message; // Menginisialisasi property message
    }

    /**
     * Method untuk mengubah sumber daya menjadi array
     * @param  \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource
        ];
    }
}

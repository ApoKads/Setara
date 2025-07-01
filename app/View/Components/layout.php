<?php

namespace App\View;

use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Judul halaman.
     *
     * @var string
     */
    public string $title; // untuk layout.blade.php menerima $title

    /**
     * Buat instance komponen baru.
     *
     * @return void
     */
    // 2. Terima variabel $title di constructor
    public function __construct(string $title = 'Setara')
    {
        // 3. Set nilai properti dari variabel yang diterima
        $this->title = $title;
    }

    /**
     * Dapatkan view / konten yang merepresentasikan komponen.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout');
    }
}
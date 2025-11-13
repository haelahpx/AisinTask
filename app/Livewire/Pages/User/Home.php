<?php

namespace App\Livewire\Pages\User;

use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.userlayout')]
#[Title('User Home')]
class Home extends Component
{
    use WithFileUploads;

    public $data_name;

    public $data_type;
    public $file;

    // rules for form validation
    protected $rules = [
        'data_name' => 'required|string|max:255',
        'file'      => 'required|file|max:4096',
    ];

    public function submit()
    {
        $this->validate();

        // set the path where the file will be stored
        $path = $this->file->store('uploads', 'public');

        DB::table('data')->insert([
            'user_id'    => Auth::id(),
            'data_name'  => $this->data_name,
            'type'       => $this->data_type,
            'status'     => 'pending',
            'data_url'   => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // reset form
        $this->reset(['data_name', 'file']);
    }
    public function render()
    {
        $mydata = DB::table('data')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.pages.user.home', [
            'mydata' => $mydata
        ]);
    }
}

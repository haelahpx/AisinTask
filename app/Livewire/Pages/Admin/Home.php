<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


#[Layout('layouts.adminlayout')]
#[Title('Admin Home')]
class Home extends Component
{
    use WithFileUploads;

    public $statusFilter = '';

    public $new_data_name;
    public $new_type;
    public $new_status = 'pending';
    public $new_file;

    public $edit_id;
    public $edit_data_name;
    public $edit_type;
    public $edit_status;
    public $showEditModal = false;

    public function create()
    {
        $this->validate([
            'new_data_name' => 'required|string|max:255',
            'new_type' => 'required|in:image,document',
            'new_status' => 'required|in:pending,approved,declined',
            'new_file' => 'nullable|file|max:2048',
        ]);

        $path = null;

        if ($this->new_file) {
            $path = $this->new_file->store('data', 'public');
        }

        DB::table('data')->insert([
            'data_name' => $this->new_data_name,
            'user_id'    => Auth::id(),
            'type' => $this->new_type,
            'status' => $this->new_status,
            'data_url' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->reset(['new_data_name', 'new_type', 'new_file']);
        $this->new_status = 'pending';

        session()->flash('message', 'Record created.');
    }

    public function edit($id)
    {
        $row = DB::table('data')->where('data_id', $id)->first();

        if ($row) {
            $this->edit_id = $row->data_id;
            $this->edit_data_name = $row->data_name;
            $this->edit_type = $row->type;
            $this->edit_status = $row->status;
            $this->showEditModal = true;
        }
    }

    public function update()
    {
        $this->validate([
            'edit_data_name' => 'required|string|max:255',
            'edit_type' => 'required|in:image,document',
            'edit_status' => 'required|in:pending,approved,declined',
        ]);

        DB::table('data')
            ->where('data_id', $this->edit_id)
            ->update([
                'data_name' => $this->edit_data_name,
                'type' => $this->edit_type,
                'status' => $this->edit_status,
                'updated_at' => now(),
            ]);

        $this->reset(['edit_id', 'edit_data_name', 'edit_type', 'edit_status', 'showEditModal']);

        session()->flash('message', 'Record updated.');
    }

    public function cancelEdit()
    {
        $this->reset(['edit_id', 'edit_data_name', 'edit_type', 'edit_status', 'showEditModal']);
    }

    public function setStatus($id, $status)
    {
        if (! in_array($status, ['pending', 'approved', 'declined'])) {
            return;
        }

        DB::table('data')
            ->where('data_id', $id)
            ->update([
                'status' => $status,
                'updated_at' => now(),
            ]);

        session()->flash('message', 'Status updated.');
    }

    public function delete($id)
    {
        DB::table('data')->where('data_id', $id)->delete();

        session()->flash('message', 'Record deleted.');
    }

    public function render()
    {
        $records = DB::table('data')
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.pages.admin.home', [
            'records' => $records,
        ]);
    }
}

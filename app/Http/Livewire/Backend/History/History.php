<?php

namespace App\Http\Livewire\Backend\History;

use App\Models\History as ModelsHistory;
use Livewire\Component;

class History extends Component
{
    public $selectedItem, $force = false;
    protected $listeners = ['refresh' => '$refresh', 'confirm', 'delete', 'restore'];

    public function render()
    {
        return view('livewire.backend.history.history');
    }

    public function restore($id)
    {
        ModelsHistory::withTrashed()->find($id)->restore();
        $this->dispatchBrowserEvent('success-izi', ['ntitle' => 'Success', 'nmessage' => "Post has been restored"]);
        $this->emit('refresh');
    }

    public function deleteSelected()
    {

        if ($this->force === false) {
            ModelsHistory::whereIn('id', $this->selectedItems)->delete();
        } else {
            ModelsHistory::onlyTrashed()->whereIn('id', $this->selectedItems)->forceDelete();
        }
        $this->clear();
        $this->dispatchBrowserEvent('success-izi', ['ntitle' => 'Success', 'nmessage' => "Users has been deleted"]);
        $this->emit('refresh');
    }


    public function confirm($item = null, $multiple = false, $permanently = false)
    {
        $this->force = $permanently;
        $this->selectedItem = $item;

        if ($item === null && $multiple === true) {
            //multiple softDelete
            $this->dispatchBrowserEvent('confirm-delete', ['mode' => 'multiple', 'item' => null, 'for' => 'trash']);
        }
        if ($item === null && $multiple === true && $permanently === true) {
            //multiple force delete
            $this->dispatchBrowserEvent('confirm-delete', ['mode' => 'multiple', 'item' => null, 'for' => 'force']);
        }

        if ($item !== null && $multiple === false && $permanently === true) {
            // single force delete
            $this->dispatchBrowserEvent('confirm-delete', ['mode' => 'single', 'item' => $item, 'for' => 'force']);
        }

        if ($item !== null && $multiple === false && $permanently === false) {
            $this->dispatchBrowserEvent('confirm-delete', ['mode' => 'single', 'item' => $item, 'for' => 'trash']);
        }
    }

    public function delete()
    {
        if ($this->force === false) {
            ModelsHistory::where('id', $this->selectedItem)->delete();
        } else {
            ModelsHistory::onlyTrashed()->find($this->selectedItem)->forceDelete();
        }
        $this->dispatchBrowserEvent('success-izi', ['ntitle' => 'Success', 'nmessage' => "Jenis layanan has been deleted"]);
        $this->clear();
        $this->emitSelf('refresh');
        return FALSE;
    }

    public function clear()
    {
        $this->reset();
    }
}

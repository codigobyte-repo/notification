<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $count = 3;

    public function getNotificationsProperty()
    {
        return auth()->user()->notifications->take($this->count);
    }

    public function incrementCount()
    {
        $this->count += 3;
    }

    public function readNotification($id){
        auth()->user()->notifications->find($id)->markAsRead();
    }

    public function resetNotification()
    {
        auth()->user()->notification = 0;
        auth()->user()->save();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}

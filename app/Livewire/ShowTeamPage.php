<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ShowTeamPage extends Component
{
    public function render()
    {
        $members = Member::orderBy('name', 'ASC')->get();
        return view('livewire.show-team-page', ['members' => $members]);
    }
}

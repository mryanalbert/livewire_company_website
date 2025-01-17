<?php

namespace App\Livewire;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowContactPage extends Component
{
    #[Validate('required')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    public $message = '';

    public function submit()
    {
        $this->validate();

        $mailData = [
            'subject' => 'You have received a contact email',
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];

        Mail::to('ryanalbertmasungsong@gmail.com')
            ->send(new ContactEmail($mailData));

        session()->flash('success', 'Thanks for contacting us, we will get back to you soon.');

        $this->redirect('/contact');
    }

    public function render()
    {
        return view('livewire.show-contact-page');
    }
}

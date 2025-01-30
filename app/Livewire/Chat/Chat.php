<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Conversation;
use App\Notifications\MessageSentNotification;

class Chat extends Component
{
    public Conversation $conversation;

    public $receiver;
    public $body;

    public $loadedMessages;
    public $paginate_var = 10;

    function listenBroadcastedMessage($event)  {

        // dd('reached');

         $this->dispatch('scroll-bottom');

         $newMessage= Message::find($event['message_id']);



         #push message

         $this->loadedMessages->push($newMessage);

         #mark as read

         $newMessage->read_at= now();
         $newMessage->save();

    }

    #[On('loadMore')]
    function loadMore()  {

        //dd('reached');

        #increment
        $this->paginate_var +=10;

        #call loadMessage
        $this->loadMessages();

        #dispatch event- update height
        $this->dispatch('update-height');

    }

    public function loadMessages() {
        $count = $this->conversation->messages()->count();
        $this->loadedMessages = $this->conversation->messages()->skip($count - $this->paginate_var)->take($this->paginate_var)->get();
        return $this->loadedMessages;
    }

    public function sendMessage() {
        $this->validate([
            'body' => 'required|string'
        ]);

        $createdMessage = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiver->id,
            'conversation_id' => $this->conversation->id,
            'body' => $this->body,
        ]);

        $this->reset('body');

         #push the message
         $this->loadedMessages->push($createdMessage);


         #update the conversation model - for sorting in chatlist
         $this->conversation->updated_at=now();
         $this->conversation->save();

         #dispatch event 'refresh ' to chatlist
         $this->dispatch('refresh')->to(ChatList::class);

         #broadcast new message

         $this->receiver->notify(new MessageSentNotification(
             auth()->user(),
             $createdMessage,
             $this->conversation
         ));
    }

    public function mount() {
        $this->receiver = $this->conversation->getReceiver();
    }

    public function render()
    {
        $this->loadMessages();
        return view('livewire.chat.chat');
    }
}

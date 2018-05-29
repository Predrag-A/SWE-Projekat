<?php

namespace App\Traits;

use App\User;
use App\Friend;

trait Friendable
{

  // Funkcija za dodavanje prijatelja sa idjem $user_requested_id
  public function add_friend($user_requested_id)
	{	
		if($this->id === $user_requested_id)
		{
			return 0;
		}
		if($this->is_friends_with($user_requested_id) === 1)
		{
			return 0;
		}
		if($this->has_pending_friend_request_sent_to($user_requested_id) === 1)
		{
			return 0;
		}
		if($this->has_pending_friend_request_from($user_requested_id) === 1)
		{
			return $this->accept_friend($user_requested_id);
		}
		$friendship = Friend::create([
			'requester' => $this->id,
			'user_requested' => $user_requested_id
		]);
		if($friendship)
		{
			return 1;
		}
		return 0;
  }
  
  // Funkcija za prihvatanje zahteva od korisnika sa idjem $requester
	public function accept_friend($requester)
	{
		if($this->has_pending_friend_request_from($requester) === 0)
		{
			return 0;
		}
		$friendship = Friend::where('requester', $requester)
						->where('user_requested', $this->id)
						->first();
		if($friendship)
		{
			$friendship->update([
				'status' => 1
			]);
			return 1;
		}
		return 0;
  }
  

  // Funkcija za vracanje liste prijatelja
	public function friends()
	{	
		$friends = array();
    
    // Niz prijatelja kojima je korisnik poslao zahtev
		$f1 = Friend::where('status', 1)
					->where('requester', $this->id)
					->get();
		foreach($f1 as $friendship):
			array_push($friends, \App\User::find($friendship->user_requested));
		endforeach;
		$friends2 = array();
    
    // Niz prijatelja ciji je zahtev prihvatio korisnik
		$f2 = Friend::where('status', 1)
					->where('user_requested', $this->id)
					->get();
		foreach($f2 as $friendship):
			array_push($friends2, \App\User::find($friendship->requester));
		endforeach;
		return array_merge($friends, $friends2);
		
  }
  
  // Funkcija za vracanje zahteva za prijateljstvo
	public function pending_friend_requests()
	{
		$users = array();
		
		$friendships = Friend::where('status', 0)
					->where('user_requested', $this->id)
					->get();
		foreach($friendships as $friendship):
			array_push($users, \App\User::find($friendship->requester));
		endforeach;
		
		return $users;
  }
  
  // Funkcija za vracanje idjeva prijatelja korisnika  
	public function friends_ids()
	{
		return collect($this->friends())->pluck('id')->toArray();
  }
  
  // Funkcija za proveru prijateljstva
	public function is_friends_with($user_id)
	{
		if(in_array($user_id, $this->friends_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
  }
  
  // Funkcija za vracanje idjeva zahteva
	public function pending_friend_requests_ids()
	{
		return collect($this->pending_friend_requests())->pluck('id')->toArray();
  }
  
  // Funkcija za vracanje poslatih zahteva
	public function pending_friend_requests_sent()
	{
		$users = array();
		$friendships = Friend::where('status', 0)
						->where('requester', $this->id)
						->get();
		foreach($friendships as $friendship):
			array_push($users, \App\User::find($friendship->user_requested));
		endforeach;
		return $users;
  }
  
  // Funkcija za vracanje idjeva poslatih zahteva
	public function pending_friend_requests_sent_ids()
	{
		return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
  }
  
  // Funkcija za proveru poslatog zahteva od strane korisnika sa idjem $user_id
	public function has_pending_friend_request_from($user_id)
	{
		if(in_array($user_id, $this->pending_friend_requests_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
  }
  
  // Funkcija za proveru poslatog zahteva ka korisniku sa idjem $user_id
	public function has_pending_friend_request_sent_to($user_id)
	{
		if(in_array($user_id, $this->pending_friend_requests_sent_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

}
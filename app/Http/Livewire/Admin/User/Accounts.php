<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Accounts extends Component
{
    public function render()
    {
        return view('livewire.admin.user.accounts' , [
            'users' => User::latest()->paginate(10),
        ]);
    }

     /**-------Show-------- */

     /**--------------Create accouts----------------*/
     public $state=[];

     public $user;
 
     public $userIdBeingRemoved = null;
 
     public $showEditModal = false;
 
    
 
     /**
      * Delete user
      * 
      * 
      */
     public function deleteUser()
     {
        $user = User::findOrFail($this->userIdBeingRemoved);
 
        $user->delete();
 
        $this->dispatchBrowserEvent('hide-delete-modal', [ 'message' => 'User deleted successfully!']);
     }
 
     public function confirmUserRemoval($userId)
     {
        $this->userIdBeingRemoved = $userId;
       
        $this->dispatchBrowserEvent('show-delete-modal');
         
     }
     /**
      * /////Delete user
      * 
      */
     
      /**Update  */
 
     public function edit(User $user)
     {
         $this->reset();
 
         $this->showEditModal = true;
         
         $this->user = $user;
 
         $this->state = $user->toArray();
 
         $this->dispatchBrowserEvent('show-form');
     }
 
     public function updateUser()
     {
         
         $data = Validator::make($this->state, [
            'name' => 'required|max:50',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'buy_fee' => 'required|numeric',
            'price_sold' => 'required|numeric',
            'sell_fee' => 'required|numeric',
            'realize_pnl' => 'required|numeric',
            'leverage' => 'required|numeric',
            'status' => 'required|max:50',
            'buy_date' => 'required|max:50',
            'sell_date' => 'required|max:50'
         ])->validate();
            //Fetch from table
            $price = $data['price'];
            $amount = $data['amount'];
            $buy_fee = $data['buy_fee'];
            $price_sold = $data['price_sold'];
            $sell_fee = $data['sell_fee'];
      
            //Calculations
            $unit = $amount / $price;
            $total = $unit * $price_sold - $sell_fee;
            $usdt_charge_b = $amount - $buy_fee;
            $usdt_gross_s = $price_sold * $unit;
            $usdt_charge_s = $usdt_gross_s - $sell_fee;
            $pnl = ($usdt_charge_s - $usdt_charge_b);

            $data['realize_pnl'] = $pnl;
       
         $this->user->update($data);
 
         // session()->flash('message' ,'User added successfully!');
 
         $this->dispatchBrowserEvent('hide-form', [ 'message' => 'User updated successfully!']);
 
         
     }
 
     /** /////Update */
     
     /**Create */
     public function createUser()
     {
         
         //dd($this->state);
         $data = Validator::make($this->state, [
            'name' => 'required|max:50',
             'price' => 'required|numeric',
             'amount' => 'required|numeric',
             'buy_fee' => 'required|numeric',
             'price_sold' => 'numeric',
             'sell_fee' => 'numeric',
             'realize_pnl' => 'numeric',
             'leverage' => 'numeric',
             'status' => 'max:50',
             'buy_date' => 'required|max:50',
             'sell_date' => 'required|max:50'
         ])->validate();

         
         //Fetch from table
         $price = $data['price'];
         $amount = $data['amount'];
         $buy_fee = $data['buy_fee'];
         $price_sold = $data['price_sold'];
         $sell_fee = $data['sell_fee'];
        
         
        
         //Calculations
         $unit = $amount / $price;
         $total = $unit * $price_sold - $sell_fee;
         $usdt_charge_b = $amount - $buy_fee;
         $usdt_gross_s = $price_sold * $unit;
         $usdt_charge_s = $usdt_gross_s - $sell_fee;
         $pnl = ($usdt_charge_s - $usdt_charge_b);

         if($pnl > 0)
         {
             $data['status'] = 'win';
         }
         

         $data['realize_pnl'] = $pnl;
         User::create($data);
         $this->dispatchBrowserEvent('hide-form', ['message' => ' added successfully!']);
         
     }
     public function addUser()
     {
         $this->reset();
         $this->showEditModal = false;
         $this->dispatchBrowserEvent('show-form');
     }
 
     /**/////create */
}

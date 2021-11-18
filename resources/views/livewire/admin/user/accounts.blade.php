<div>
  <!-- Content Header (Page header) -->
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">

              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Users</h1>
              </div><!-- /.col -->

              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active">Accounts</li>
                </ol>
              </div><!-- /.col -->

            </div><!-- /.row -->
         </div><!-- /.container-fluid -->
  </div><!-- /.container-header -->

  <!-- Main content -->
  <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <div class="d-flex justify-content-end mb-2">
              <button wire:click.prevent="addUser" class="btn btn-info"><i class="fa fa-plus-circle mr-1"></i>Add new user</button>
            </div>
            <div class="card">
              <div class="card-body">
            
                  
                 <table class="align-middle mb-0 table table-borderless table-hover">
                    <thead class="text-muted text-white " style="font-size: 18px ; height: 55px; background-color: #3f74e0; "  >
                        <tr>
                        <th scope="col"  class="text-center">Sn</th>
                        <th scope="col"  class="text-center">Name</th>
                        <th scope="col"  class="text-center">Price</th>
                        <th scope="col"  class="text-center">Amount</th> 
                        <th scope="col"  class="text-center">Leverage</th>     
                        <th scope="col"  class="text-center">Price Sold</th>
                        <th scope="col"  class="text-center">PNL</th>
                        <th scope="col"  class="text-center">Status</th>
                        <th scope="col"  class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody wire:loading.class="">
                    @forelse ($users as $user )
                    <tr>
                       <td class="text-center  ">{{ $loop->iteration }}</td>
                       <td class="text-center  ">{{ $user->name }}</td>
                       <td class="text-center  ">{{ $user->price}}</td>
                       <td class="text-center  ">{{ $user->amount }}</td>
                       <td class="text-center  ">{{ $user->leverage }}</td>
                       <td class="text-center  ">{{ $user->price_sold }}</td>   
                       <td class="text-center  ">{{ $user->realize_pnl }}</td>
                       <td class="text-center  ">
                         @if ($user->status == 'win')
                          <span class="text-success text-uppercase">{{ $user->status }}</span>
                         @else
                         <span class="text-danger">{{ $user->status }}</span>
                         @endif
                        </td>
                       
                
                       <td class="text-center ">
                       <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm  d-inline" wire:click.prevent="edit({{ $user }})"><i class="fas fa-edit"></i></button>
                          <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm  d-inline" wire:click.prevent="confirmUserRemoval({{ $user->id }} )"><i class="fas fa-trash"></i></button> 
                       </td>
                     </tr>
                    @empty
                       <tr class="text-center text-muted">
                              <td colspan="8">
                                  <p class="mt-2 " style="font-size: 20px;">No result found</p>
                              </td>
                       </tr>
                    @endforelse
                    
                        
                       
                     
                    </tbody>
                 </table>
                 
                  
              </div>
              <div class="footer d-flex justify-content-end mr-2">
                  
                    {{ $users->links() }}
                 
              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
    <!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog" role="document">
    <!--form-->
  <form wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser'}}">
    <div class="modal-content">
      <div class="modal-body">
      <div class="row gutters text-muted ">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-success" style="font-size: 20px; font-weight: bold">Buy</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-success" style=" font-size: 14px">
					<label for="surname">Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="surname"  wire:model.defer="state.name">
             @error('name')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror       
        </div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-success" style=" font-size: 14px">
					<label for="first_name">Price</label>
					<input type="text" class="form-control @error('price') is-invalid @enderror" id="first_name"  wire:model.defer="state.price">
             @error('price')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror
        </div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-success @error('amount') is-invalid @enderror" style=" font-size: 14px">
					<label for="middle_name">Amount</label>
					<input type="text" class="form-control" id="middle_name"  wire:model.defer="state.amount">
             @error('amount')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror
        </div>
			</div>
		
			<!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="sex">Sex</label>
					<select class="custom-select form-control text-muted" >
						  <option value="">Select</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
            		</select>
				</div>
			</div> -->
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-success" style=" font-size: 14px">
					<label for="nationality">Buy Fee</label>
					<input type="text" class="form-control @error('buy_fee') is-invalid @enderror" id="nationality"  wire:model.defer="state.buy_fee">
             @error('buy_fee')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror
        </div>
			</div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-success" style=" font-size: 14px">
					<label for="nationality">Leverage</label>
					<input type="text" class="form-control @error('buy_fee') is-invalid @enderror" id="nationality"  wire:model.defer="state.leverage">
             @error('leverage')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror
        </div>
			</div>
      
		</div> <!-- ./Buy -->
		<div class="row gutters text-muted">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mt-3 mb-2 text-danger" style=" font-size: 20px; font-weight: bold">Sell</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-danger" style=" font-size: 14px">
					<label for="home_phone_number">Price Sold</label>
					<input type="text" class="form-control @error('price_sold') is-invalid @enderror" id="home_phone_number"  wire:model.defer="state.price_sold">
            @error('price_sold')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror
        </div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-danger" style=" font-size: 14px">
					<label for="mobile_phone_number">Sell Fee</label>
					<input type="text" class="form-control @error('sell_fee') is-invalid @enderror" id="mobile_phone_number"  wire:model.defer="state.sell_fee">
            @error('sell_fee')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror
        </div>
			</div>
			
			
		</div>
    
    <div class="row gutters text-muted">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mt-3 mb-2 text-info" style=" font-size: 20px; font-weight: bold">Date</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-info" style=" font-size: 14px">
					<label for="home_phone_number">Buy Date</label>
					<input type="text" class="form-control @error('buy_date') is-invalid @enderror" id="home_phone_number" wire:model.defer="state.buy_date">
            @error('buy_date')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror
        </div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group text-info" style=" font-size: 14px">
					<label for="mobile_phone_number">Sell Date</label>
					<input type="text" class="form-control @error('sell_date') is-invalid @enderror" id="mobile_phone_number" wire:model.defer="state.sell_date">
            @error('sell_date')
              <div class="text-danger mt-1 ml-1">{{ $message }}</div>
             @enderror
        </div>
			</div>
			
			
		</div>
    <!--end inputs-->     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary w-25" data-dismiss="modal"><i class="fas fa-times mr-1"></i> Cancel</button>
        <button type="submit" class="btn btn-primary w-25"><i class="fas fa-save mr-1"></i>
        
          <span>Save</span>
          
        </button>
      </div>
    </div>
    </form>
  </div>
</div>
    <!--End modal-->

<!--Delete confirmation modal -->
<div id="confirmationModal" class="modal fade" wire:ignore.self>
	<div class="modal-dialog modal-confirm ">
		<div class="modal-content ">
			<div class="modal-header flex-column">
				<div class="icon-box ">
					<i class="fas fa-trash">&#xE5CD;</i>
				</div>						
				<h4 class="modal-title w-100">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? This process cannot be undone.</p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" wire:click.prevent="deleteUser">Delete</button>
			</div>
		</div>
	</div>
</div>     
<!--Delete confirmation modal -->

    <!--End modal-->
</div><!-- /.last div -->

<style>
    .modal-confirm {		
      color: #636363;
      width: 400px;
    }
    .modal-confirm .modal-content {
      padding: 20px;
      border-radius: 5px;
      border: none;
      text-align: center;
      font-size: 14px;
    }
    .modal-confirm .modal-header {
      border-bottom: none;   
      position: relative;
    }
    .modal-confirm h4 {
      text-align: center;
      font-size: 26px;
      margin: 30px 0 -10px;
    }
    .modal-confirm .close {
      position: absolute;
      top: -5px;
      right: -2px;
    }
    .modal-confirm .modal-body {
      color: #999;
    }
    .modal-confirm .modal-footer {
      border: none;
      text-align: center;		
      border-radius: 5px;
      font-size: 13px;
      padding: 10px 15px 25px;
    }
    .modal-confirm .modal-footer a {
      color: #999;
    }		
    .modal-confirm .icon-box {
      width: 80px;
      height: 80px;
      margin: 0 auto;
      border-radius: 50%;
      z-index: 9;
      text-align: center;
      border: 3px solid #f15e5e;
    }
    .modal-confirm .icon-box i {
      color: #f15e5e;
      font-size: 46px;
      display: inline-block;
      margin-top: 13px;
      margin-left: 17px;
    }
    .modal-confirm .btn, .modal-confirm .btn:active {
      color: #fff;
      border-radius: 4px;
      background: #60c7c1;
      text-decoration: none;
      transition: all 0.4s;
      line-height: normal;
      min-width: 120px;
      border: none;
      min-height: 40px;
      border-radius: 3px;
      margin: 0 5px;
    }
    .modal-confirm .btn-secondary {
      background: #c1c1c1;
    }
    .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
      background: #a8a8a8;
    }
    .modal-confirm .btn-danger {
      background: #f15e5e;
    }
    .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
      background: #ee3535;


      /**Loading indivator */
      
    }
</style>
@extends('web.layout')

@section('content')

<div class="col-md-12 mt">
    @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('type') }}">
                <b>{{ Session::get('message') }}</b> 
            </div>
    @endif
    
	<div class="content-panel">
      <table class="table table-hover" id="trip-table">
          <thead>
          <tr>
              <th>Pickup</th>
              <th>Provider</th>
              <th>Fare</th>
              <th>Type of Service</th>
          </tr>
          </thead>
          <tbody>
          @foreach($requests as $request)
          <tr class="trip-basic" data-id="{{ $request->id }}">
              <td>{{ date('l, F d Y h:i A',strtotime($request->request_start_time)) }}</td>
              <td>{{ $request->first_name }} {{ $request->last_name }}</td>
              <td>{{ $request->total }}</td>
              <td>{{ $request->type }}</td>
          </tr>
          <tr class="trip-detail" style="display:none;">
          	<td colspan="4"><center>Loading...</center></td>
          </tr>
          @endforeach
          
          </tbody>
      </table>
	  </div>
</div>

<script type="text/javascript">
	
	$(function() {
		$( ".trip-basic" ).click(function() {
			var $this = $(this);
			var id = $(this).data('id');
			$this.next().toggle();
			$.ajax({ url: "<?php echo web_url(); ?>/user/trip/"+id,
	         type: 'get',
	         success:
	         function(msg) {
		         if(msg === 'false'){
		            alert('No Data Found');
		         }
		         else{
		            $this.next().html(msg);
		         } 
	       	 }
	        });
	         
		});


	});

</script>

    <!--script for this page-->
    <script type="text/javascript">
      var tour = new Tour(
        {
          name: "userappHome",
        });

        // Add your steps. Not too many, you don't really want to get your users sleepy
        tour.addSteps([
          {
            element: "#flow1", 
            title: "Requesting a Trip", 
            content: "Click here to request your first trip",  
          }
       ]);

     // Initialize the tour
     tour.init();

     // Start the tour
     tour.start();
</script>

@stop 
@extends('admin.layouts')
@section('title', 'Admin')
@php 
    $name="Payments";$route="payments";
@endphp              
@section('content_header')
    <h1 class="m-0 text-dark">{{$name}} Management</h1>
@stop

@section('content')
    @parent
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          @php 
            $addbar=["name"=>$name,"add-data"=>false,"add-name"=>"Add ". Str::singular($name),"add-anchor"=>route($route.'.create')];
          @endphp
          @include("admin.common.add-bar")
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-12">
         
          <div class="card  ">
            <div class="card-header">
              <h3 class="card-title">{{ $name }} Listing</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data-table-gaurav" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> #</th>
                        <th>Booking ID</th>
                        <th>Property Name</th>
                        <th>Customer Name</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Tran ID</th>
                        <th>Request of Date</th>
                      
                        
                 
                    </tr>
                </thead>
                <tbody>
                        @php $sno=1;@endphp
                    @foreach($data as $client)
                        @php
                            $booking=App\Models\BookingRequest::find($client->booking_id);
                        @endphp
                        <tr>
                           
                            <td>{{ $sno++ }}</td>
                            <td>
                                {{ $booking->id ?? 'Booking Not Available' }}
                            </td>

                            @php
                                if($booking)
                                $property=App\Models\Property::find($booking->property_id);
                            @endphp
                            <td> 
                                {{ $property->name ?? 'Property Not Available' }}
                            </td>
                            <td> 
                                {{ $booking->name ?? 'Booking Not Available' }}
                            </td>
                            <td>
                                {{ $client->type }}
                            </td>
                            <td>
                                {{ $client->amount }}
                            </td>
                            <td>
                                {{ $client->tran_id }}
                            </td>
                            <td>
                                {{ $client->created_at }}
                            </td>
                       
                          
                           
                         
                            
                        </tr>
                    @endforeach
                </tbody>
           
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@stop
@section("js")
@parent
<script>
  $("#data-table-gaurav").DataTable({"lengthMenu": [[ 50, -1], [ 50, "All"]]});

 
</script>
@stop
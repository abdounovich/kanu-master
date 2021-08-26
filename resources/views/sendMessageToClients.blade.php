
@extends('layouts.master')

@section('title', 'Clients')



@section('content')
@if (\Session::has('success'))
    <div class="alert  alert-info  text-right ">
        <ul>
            <li class="p-2">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="row mr-4 p-4">
    

    <h2  class="float-right text-white">محتوى الرسالة </h2>
</div>
<div class="container">

@if ($id=="0")
     <form action="/sendMsg/{{$id}}" method="post">
        @csrf    
         <div class="form-group col col-12 p-4 mr-3 " style="opacity: 0.7">


    <textarea class="form-control bg-dark text-white " autofocus name="message" id="message"  rows="10"></textarea>
<div class="row d-flex justify-content-center"><input type="submit" class="btn btn-success p-2 m-4  align-items-center   "  disabled id="btnSubmit" value=" إرسال إلى جميع الأعضاء  ">   
</div>
        </div>

        </form>
@else

@php
    $client=App\Client::where("fb_id",$id)->first();
    $message=" إرسال إلى ".$client->facebook;
    
@endphp
<form action="/sendMsg/{{$id}}" method="post">
    @csrf    
     <div class="form-group col col-12 p-4 mr-3 " style="opacity: 0.7">


<textarea class="form-control bg-dark text-white " autofocus name="message" id="message"  rows="10"></textarea>
<div class="row d-flex justify-content-center"><input type="submit" class="btn btn-success p-2 m-4  align-items-center   "  disabled id="btnSubmit" value="{{$message}}">   
</div>
    </div>

    </form>

    
@endif
      
      
</div>





<script >$('#message').on('keyup keypress', function(e) {
    if($(this).val().length >=0) {
        $("#btnSubmit").attr("disabled", false);
    }
  });

  $('#message').on('keyup', function() {
    if($(this).val().length == 0) {
        $("#btnSubmit").attr("disabled", true);
    }
  })</script>



 

  





@stop
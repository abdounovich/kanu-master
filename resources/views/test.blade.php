<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IK9 </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
    <script src="{{URL::asset('js/jquery.throttle.js')}}"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/css/jquery.classycountdown.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/js/jquery.classycountdown.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">

<style>body{
background:url(https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599670310/1_zvsdhh.jpg) ;
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
font-family: 'Cairo', sans-serif;

}
  .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

#top-menu a{
background-color: green;
color: white;
font-weight:bold;
}

#top-menu input:hover{
    color: white;
    background-color:deepskyblue
}
#top-menu input:focus{
    color: white;
    background-color:deepskyblue
}



</style>

<!-- Optionally add this to use a skin : -->
    <!-- Styles -->
</head>
<body dir="ltr">


@php
  $OneApp=App\Appointment::where('facebook',$username)
    ->where('ActiveType','1')->count();
    
   @endphp 




{{-- @php

date_default_timezone_set("Africa/Algiers");

$debut="10:00";
$debut=date("Y-m-d ").$debut.":00";
$debut=date("Y-m-d H:i:s", strtotime(date($debut)));

$fin="22:00";
$fin=date("Y-m-d ").$fin.":00";
$fin=date("Y-m-d H:i:s", strtotime(date($fin)));

$pas=60*30;
$arr=array();

@endphp

@while ($debut<$fin)

@foreach ($appointments as $appointment ) 

@php
$d=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->debut.":00"));
$f=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->fin.":00"));
@endphp

@if ($debut>=$d && $debut<$f) 

<button class='btn btn-danger disabled' type='button'>{{$debut}}</button>

@else

<button class='btn btn-success' type='button'>{{$debut}}</button>

@endif
    
@php
$debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + $pas));
@endphp 

@endforeach

@endwhile
 --}}
 {{--    @foreach ($appointments as $appointment )   
        @for ($i=0; $i <count($arr) ; $i++) 
        @php
        $arr2=array();
        $d=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->debut.":00"));
        $f=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->fin.":00"));
        @endphp
        @if ($arr[$i]>=$d && $arr[$i]<$f) 
                <button class="btn btn-danger disabled" type="button">{{$arr[$i]}}</button>

        
        @else
        
        <button class="btn btn-success" type="button">{{$arr[$i]}}</button>

        @endif @endfor @endforeach --}}


@if ($OneApp>0) 
<div  class="h3 bg-danger text-white text text-center p-2 m-2  rounded" >عفوا صديقي لا يمكنك حجز أكثر من موعد  </div>


    
@else
    


    

<div>

            <div class="container">

                @php
                $date = date("Y-m-d");

                @endphp

@if (empty($items))

<div  class="h3 bg-danger text-white text text-center p-2 m-2  rounded" >عفوا صديقي كل المواعيد محجوزة  </div>

    @php
        return;
    @endphp
@endif
                @switch($var)
                    @case(1)
                    
                    <div  class="h3 bg-success text-white text text-center p-2 m-2  rounded" >المواعيد المتاحة اليوم  </div>

                        @break
                    @case(2)
            <div  class="h3 bg-success text-white text text-center p-2 m-2  rounded" > المواعيد المتاحة غدا   </div>

                        @break
                  
                        @case(3)
                        <div  class="h3 bg-success text-white text text-center p-2 m-2  rounded" >المواعيد المتاحة بعد غد  </div>

                     
                @endswitch
                
            <div id="top-menu"  class=" bg-dark m-2 p-2 align-self-center justify-content-center align-items-center " style="opacity: 0.8">
            @foreach ($items as $item)
            @php   
            date_default_timezone_set("Africa/Algiers");
            $item2=date("H:i", strtotime(date($item)));
            $time_now = date("Y-m-d H:i:s");
            @endphp
            @if ($var==1)
                
           
            @if ($item<$time_now)
            <a href="#" class ="btn btn-warning disabled p-2 m-1 bg-danger text-white border border-danger"  >
            {{$item2}}
            </a>
            @else
            <input class="btn btn-success  p-2 m-1" name="{{$item}}" onclick="getvalue()"  type="button" value="{{$item2}}">
            @endif
            @else
            <input class="btn btn-success  p-2 m-1" name="{{$item}}"  onclick="getvalue()" type="button" value="{{$item2}}">


             @endif
            @endforeach



            </div>
            <div class="row">
                <div class=" col col-12 ">
                        <input type="button" class="btn btn-success" id="clc" onclick="sendMessage()" style="display: none; width:100%" value="  تأكــــيد الموعـــد ">
                </div>
                </div>
            </div>


        
       
{{-- @foreach ($arr as $item)  
              
        
          @php
          date_default_timezone_set("Africa/Algiers");

          $time_now = date("Y-m-d H:i:s");
          $today=$item;
          $debut=$appointment->jour.' '.$appointment->debut.":00";
          $fin=$appointment->jour.' '.$appointment->fin.":00";
  
              $d=date("H:i", strtotime(date($today)));
          @endphp

          @if ("2020-09-19 11:00:00" <=$today and  $today<"2020-09-19 16:30:00" )
         
          <a href="#" class ="btn btn-warning disabled p-2 m-2 bg-danger text-white border border-danger"  >
          {{$d}}</a>
          @else
          <a href="#" class ="btn btn-success  p-2 m-2 text-white "  >
            {{$d}}</a>
          @endif

  @endforeach --}}



   

        

   




    
<form id="myForm" method="POST" action="/test2">
    @csrf




    
<input type="hidden" name="message" value=" 👏 شكرا لك  {{$username}} لقد تم حجز  موعدك بنجاح 👌👌  "> 
   <input type="hidden" id="id" name="id"><br>
   <input type="hidden" name="debut"  id="debut" >
   <input type="hidden" name="type" id="type" value="{{$type->id}}">
   <input type="hidden" name="jour" id="jour" value="{{$jour}}">
   <input type="hidden" name="username" id="username" value="{{$username}}">
   <input type="hidden" name="Cid" id="Cid" value="{{$Cid}}">




             
  
  </form>

    <script type="text/javascript">



function getvalue() {
                var debut =document.getElementById("debut");


                debut.value =event.target.name;
                var x = document.getElementById("clc");
 
 x.style.display = "block";

}
        function sendMessage() {
            document.getElementById("myForm").submit();

        
            MessengerExtensions.requestCloseBrowser(function success() {

            }, function error(err) {

            });
        }

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) { return; }
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.com/en_US/messenger.Extensions.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "Messenger"));

        window.extAsyncInit = function () {
            // the Messenger Extensions JS SDK is done loading
            MessengerExtensions.getUserID(function success(uids) {
                var psid = uids.psid;//This is your page scoped sender_id
                document.getElementById("id").value =psid;

            }, function error(err) {
/*                 alert("Messenger Extension Error: " + err);
 */            });
        };
    </script>
</div>
@endif
</body>
</html>
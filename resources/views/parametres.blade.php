
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

@if (\Session::has('erreur'))
    <div class="alert  alert-danger  text-right ">
        <ul>
            <li class="p-2">{!! \Session::get('erreur') !!}</li>
        </ul>
    </div>
@endif



 <form  method="post" action="addAppoint">
    @csrf
    <div class="row">
        
   <div class="col col-2 p-2"><label class="h4 text-white " for="debut">من :</label>
</div>
<div class="col col-10 p-2">
    <input class="form-control  "  type="time" name="debut" id="debut">
</div>

</div>

<div class="row">
        
    <div class="col col-2 p-2">
     <label  class="h4 text-white" for="fin" >إلى  :</label>
    </div>
    <div class="col col-10 p-2">
    <input class="  form-control"type="time" name="fin" id="fin">
</div>

</div>
<div class="row">
        
    <div class="col col-2 p-2">
    <label  class="h4 text-white" for="jour">يوم :</label>
</div>
<div class="col col-10 p-2">
  <input class="form-control"   type="date" name="jour" id="jour">

</div>

</div>
<div class="row">
    
<div class="col col-8">
    <input class="  btn btn-success"   type="submit" value="إضافة">
</div></div>
</form>
           

 
  


<div class="container">

@php
    $appointments=App\Appointment::where("ActiveType",5)->get();
@endphp






<table class="table bg-dark text-white mt-5">
    <thead>
    
    </thead>
    <tbody>
     
        @foreach ($appointments as $appointment)
        <tr>
            <th scope="row">{{$loop->index+1}}</th>
            <td>{{$appointment->jour}}</td>
            <td>{{$appointment->debut}}</td>
            <td> {{$appointment->fin}}</td>
            <td class="text-left">        <a  class="btn btn-danger "  value="" href="/annulerByAdmin/{{$appointment->id}}">حذف</a>
                <a  class="btn btn-warning "  value="" href="#">تعديل</a>
            </td>
          </tr>
         


        
    
    @endforeach
     
       
     
    </tbody>
  </table>






</div>
<div>
 <form action="/parametres/update/" method="POST">
    <table class="table  table-bordred">

    <tr class="bg-dark text-white text-center">
        <td>اليوم </td>
        <td>البداية </td>
        <td>النهاية </td>
        <td>بداية الراحة </td>
        <td>نهاية الراحة </td>
        <td>الحالة </td>

    </tr>
    @php
    $arabic = ['السبت' ,'الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة' ]; 
    $anglais = ['Saturday' ,'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday' ];  
   
    @endphp
  
@csrf @for ($i = 0; $i < 7; $i++)
<tr class="bg-secondary text-white text-center">

        <td>{{$arabic[$i]}}</td>
        <td><input class="form-control {{$anglais[$i]}} " @if (Setting::get($anglais[$i].'.active')=="0" ) readonly @endif type="time" name="{{$anglais[$i].'-debut'}}" value="{{Setting::get($anglais[$i].'.debut')}}"></td>
        <td><input class="form-control {{$anglais[$i]}} "@if (Setting::get($anglais[$i].'.active')=="0" ) readonly @endif type="time" name="{{$anglais[$i].'-fin'}}" value="{{Setting::get($anglais[$i].'.fin')}}"></td>
        <td><input class="form-control {{$anglais[$i]}}"@if (Setting::get($anglais[$i].'.active')=="0" ) readonly @endif type="time" name="{{$anglais[$i].'-debut-repos'}}" value="{{Setting::get($anglais[$i].'.debut-repos')}}"></td>
        <td><input class="form-control {{$anglais[$i]}} " @if (Setting::get($anglais[$i].'.active')=="0" ) readonly @endif type="time" name="{{$anglais[$i].'-fin-repos'}}" value="{{Setting::get($anglais[$i].'.fin-repos')}}"></td>
        <td><input  class="" type="checkbox"    
            @if (Setting::get($anglais[$i].'.active')=="1" ) checked  
            @endif 
            onchange="myFunction('{{$i}}')" id="cb{{$i}}" data-on="مفعل" 
            data-off="موقف" data-onstyle="outline-success" data-offstyle="outline-danger"  data-toggle="toggle"></td>
  <input type="hidden" id="{{$i}}" name="{{$anglais[$i].'-active'}}" value="{{Setting::get($anglais[$i].'.active')}}">
      </tr>
@endfor

   
</table>
<div class="col col-12 text-center ">
    <button style="width: 100%" type="submit" class="btn btn-success">  حفظ التغييرات </button>

 </div>
 </form>


</div>
<script>
    function myFunction($id) {
    var checkbox=document.getElementById("cb"+$id);
    var hidden_input=document.getElementById($id);


  
     
  /*     window.location = "/actif/"+$fid;
   */  
      
  
   if (checkbox.checked == true){
    hidden_input.value="1";

    } else {
        hidden_input.value="0";

   }
  
  }
  
  ;</script>
@stop
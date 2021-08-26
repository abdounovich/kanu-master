
@extends('layouts.master')

@section('title', 'Clients')



@section('content')





 

  




<div class="container">
  <div class="row m-5 p-3">
  
 
    
  
    <h3 class="p-2 text-white">قائمة الزبائن :  </h3>
    <table class="table table-striped table-dark"style="opacity:0.9">
      <thead class=" bg-success text-right">
        <tr>
          <th scope="col">#</th>          

          <th scope="col">الفيسبوك</th>
          <th scope="col">الرصيد
          </th>
          <th scope="col">تاريخ التسجيل </th>

        </tr>
      </thead>
      <tbody class=" text-right">
        @php
        $counter=0;
        @endphp
        @foreach ($clients as $client)
        @php
           $counter=$counter+1; 
      
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$client->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp
        <tr>
          <th scope="row">{{$counter}}</th>
          <td class="align-middle"><img style="border-width: 5px;" class="  border border-white ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$client->facebook}}</td>
         
        <td class="align-middle">
          <span class="badge badge-success badge-pill p-2">
            <form action="{{route("client.editpoints",$client->id)}}" method="post">
              @csrf
            <input type="text" name="points" value="{{$client->points}}" id="">            
            <button class="btn btn-primary" type="submit">تغيير</button>

          </form>

          </span> 
        </td>
    
            <td class="align-middle"> @php  carbon\Carbon::setLocale('ar');
              echo $client->created_at->diffForHumans(); @endphp    </td>

        </tr>
    
        @endforeach
      </tbody>
    </table>
  </div>
</div>


<div class=" container">
  <div class="row">
  <div class=" justify-content-center">{{$clients->links()}}
 </div>
</div> 
</div>




@stop
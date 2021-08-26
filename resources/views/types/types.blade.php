
@extends('layouts.master')

@section('title', 'types_page')



@section('content')







    <div class=" container mt-5">
        <div class="row mt-5">
            <h2 class=" text-white p-2">أنواع الحلاقة :</h2>
            <table class="table table-dark table-hover" style="opacity: 0.9 ">
 <thead class=" bg-success text-center">

                    <tr>
                      <th>النوع   </th>
                      <th>السعر </th>
                      <th>المدة </th>
                      <th> الرصيد</th>
                      <th> الصورة</th>
                      <th> </th>
                     
                   
                    </tr>
                  </thead>
                  <tbody class=" text-center">
                   @foreach ($types as $type)
                    <tr class=" align-items-center text-center">
                    
                         <td class="align-middle">{{$type->type}}</td>
                         <td class="align-middle">{{$type->prix}} دج </td>
                         <td class="align-middle">{{$type->temps}} دقيقة </td>
                         <td class="align-middle">{{$type->point}}</td>
                         <td class="align-middle"><img class="img border  border-white" width="50" height="50"  src="{{$type->photo}}" alt=""></td>
<td>  
   

<a class="btn btn-info  m-2 " href="/edit/{{$type->id}}">تعديل</a>

  

  <a href="/delete/{{$type->id}}" type="submit" class="btn btn-danger  m-2" >حذف</a>
</td>
            
                    </tr> @endforeach 
                  </tbody>
                
            </table>
        </div>
    </div>









        <div class="container">
            <div class="card mt-5 mb-5" style="opacity: 0.9"  >
                <div class="card-header  bg-success text-white ">           <h4 class=" text-center p-2 ">أضف نوع جديد </h4>
                </div>
                <div class="card-body bg-dark text-white"> <div>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                      <form method="post" action="/types" role="form" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">    
                              <label for="type" class=" float-right">  نوع الحلاقة :</label>
                              <input type="text" class="form-control" name="type"/>
                          </div>
                
                          <div class="form-group">
                              <label for="prix" class=" float-right">السعر: </label>
                              <input type="text" class="form-control" name="prix"/>
                          </div>
                
                          <div class="form-group">
                              <label for="temps" class=" float-right">الوقت:</label>
                              <input type="text" class="form-control" name="temps"/>
                          </div>
                          <div class="form-group">
                              <label for="point" class=" float-right">الرصيد :</label>
                              <input type="text" class="form-control" name="point"/>
                          </div>

                          <div class="form-group">
                            <label for="photo" class=" float-right">الصورة :</label>
        <div class="row">
          <div class="col-2">
            <input type="file" id="imgupload" onchange="loadFile(event)"  name="photo" hidden>
        <a href="#" onclick="$('#imgupload').trigger('click'); return false;"> 
           <img class="img " id="image" 
           src="https://res.cloudinary.com/ds9qfm1ok/image/upload/v1595881085/gallery-131964752828011266_ko0lhf.png"
            alt="" width="200" height="200">
        </a>
          </div>
          
        </div>
                            
                                     
                        </div>
                        <script>
                            var loadFile = function(event) {
                                var image = document.getElementById('image');
                                image.src = URL.createObjectURL(event.target.files[0]);
                            };
                            </script>   
                            
                            
                    <div class="row">
                       
                        <div class="col col-12">
                           <button style="width: 100%" type="submit" class="btn btn-success">  اضافة</button>
 
                        </div>
                      
                    </div>    
                      
                        </form>
                  </div></div> 
              </div>   
    
        <div class="row">
        <div class="col-sm-8 offset-sm-2">
        
       </div>
       </div>
    </div>



   
   

@stop

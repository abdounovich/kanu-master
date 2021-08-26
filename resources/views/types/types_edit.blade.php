<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" /> 

   
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>      
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
<style>
body{

background:url(https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599670310/1_zvsdhh.jpg) ;background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
font-family: 'Cairo', sans-serif;
}
    
</style>
</head>
<body  dir="rtl">







        <div class="container">
            <div class="card mt-5 mb-5" style="opacity: 0.9"  >
                <div class="card-header  bg-success text-white ">           <h4 class=" text-center p-2 "> تعديل  " {{$type->type}} "  </h4>
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
                    <form method="post" action="/types_edit/{{$type->id}}" role="form" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">    
                              <label for="type" class=" float-right">  نوع الحلاقة :</label>
                          <input type="text" class="form-control" value="{{$type->type}}" name="type"/>
                          </div>
                
                          <div class="form-group">
                              <label for="prix" class=" float-right">السعر: </label>
                              <input type="text" class="form-control" value="{{$type->prix}}" name="prix"/>
                          </div>
                
                          <div class="form-group">
                              <label for="temps" class=" float-right">الوقت:</label>
                              <input type="text" class="form-control" value="{{$type->temps}}" name="temps"/>
                          </div>
                          <div class="form-group">
                              <label for="point" class=" float-right"> النقاط:</label>
                              <input type="text" class="form-control"  value="{{$type->point}}" name="point"/>
                          </div>

                          <div class="form-group">
                            <label for="photo" class=" float-right">الصورة :</label>
        <div class="row">
          <div class="col-2">
            <input type="file" id="imgupload" onchange="loadFile(event)"  name="photo" hidden>
        <a href="#" onclick="$('#imgupload').trigger('click'); return false;"> 
           <img class="img " id="image"  
           src="{{$type->photo}}"
            alt="" width="200" height="200">           
            <input value="{{$type->photo}}" class="form-control" type="hidden" name="image">

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
                           <button style="width: 100%" type="submit" class="btn btn-success">  حفظ التغييرات</button>
 
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



   

    

</body>
</html>
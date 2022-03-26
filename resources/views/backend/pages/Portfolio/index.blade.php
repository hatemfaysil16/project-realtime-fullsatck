@extends('layouts.backend.mastar')



@section('title')
slider
@endsection

@section('css')

@endsection


@section('content')
    <!--start index -->

{{--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  --}}

    <div class="py-12">
        <div class="container">
            <div class="row">
  


     

                  {{--  <div class="card-header"> </div>  --}}




        
                  <div class="col-md-8">
                    <div class="card-group">
                      @foreach ($images as $image)

                      <div class="col-md-4 ml-5">

                        <div class="card">
                          
                         <button>    
                          <a href="{{route('delete.multi',$image->id)}}" value="{{$image->id}}" >
                            <svg  width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                          </a>      
                         </button>

                            <img src="{{asset($image->image)}}" alt="" >
                          </div>
                      </div>

                      


                      @endforeach




                </div>
              </div>

              
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Multi image</div>
                  <div class="card-body">

                  <form action="{{route('store.image')}}" method="Post" enctype="multipart/form-data" >
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Multi image</label>
                      <input type="file" class="form-control" name="image[]" multiple ="" id="exampleInputEmail1" aria-describedby="emailHelp">
                
                        @error('image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                  </form>
                </div>
                  
                </div>
              </div>

            </div>
        </div>
    </div>
    
@endsection

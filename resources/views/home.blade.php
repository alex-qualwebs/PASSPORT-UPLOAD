@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

    
        @if(session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
         </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h1>Upload image</h1>
            </div>
            <div class="card-body">
                <div class="form">
               <form method="post" action="store" enctype="multipart/form-data">
                @csrf
                {{  $errors->first('uploadfile') }}
                <input type="file" name="uploadfile" class="form-control">
                <br>
                <input type="submit" value="Upload" class="btn btn-success btn-lg">
                </form>
                </div>
            </div>
        </div>
     </div> 
      
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layout.app')
@section("content")
<main class="app-main content-wrapper">
   <div class="app-content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="mb-0">My student Subjects <span style=" color:blue;">({{$getuser->name}}{{$getuser->last_name}})</span>  </h1>
            </div>
         </div>
      </div>
   </div>
   <div class="app-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               @include('_message')
               <div class="card ">
                  <div class="card-header">
                        <h3 class="card-title">Student Subjects</h3>
                    </div>
                    <div class="card-body p-0" >                
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Subject name</th>
                              <th>Subject type</th>
                           </tr>
                        </thead>
                        <tbody>

                          

                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection
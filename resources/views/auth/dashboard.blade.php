@extends('layouts.master')
@section('content')


          <div class="xv">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="aqua" fill-opacity="1" d="M0,32L40,48C80,64,160,96,240,112C320,128,400,128,480,112C560,96,640,64,720,74.7C800,85,880,139,960,170.7C1040,203,1120,213,1200,224C1280,235,1360,245,1400,250.7L1440,256L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
          </div>
          <style>
            .xv {
              height: 100rem;
              width: 80rem;
              position: fixed;
              margin: 18rem -5rem ;
              z-index: -999;
            }
            @media only screen and (max-width: 600px) {
                .xv {
                  margin: 18rem -19rem ;
                }
           }
          </style>
          @endsection
@include('layouts.separete.header')
@include('layouts.separete.navbar')
@include('layouts.separete.sidebar')

<div class="ac">
@yield('content')

</div>

<style>
    .ac {
        display: flex;
        margin: 4rem 18.5rem  ;
    }

    /* @media only screen and (max-width: 600px) {
        .ac {
        display: flex;
        margin: 0rem 15rem;
       
    }
    } */
</style>

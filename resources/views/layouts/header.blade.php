<div class="col-md-8">
  <form action="{{ route('universidades.search') }}" method="POST" class="search">
      @csrf
      <input type="text" id="search" name="search" placeholder="Search">
      <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
  </form>
</div>
{{-- 
<header id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand a-h logo" href="{{route('home.index')}}">santins</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
              <div class="navbar-nav">

                @if($user)
                <span class="nav-item nav-link s-h">
                    <a href="{{route('dashboard')}}" style="font-size: 40px; text-decoration:none">
                        {{ Auth::user()->name}}
                    </a>
               </span>
               @else
                <span class="nav-item nav-link s-h">Faça o
                     <a href="{{route('login')}}">LOGIN</a>
                </span>
                <span class="nav-item nav-link s-h">ou se
                     <a href="{{route('register')}}">REGISTRE</a>
                </span>
                @endif

              </div>
            </div>
          </nav>
    </div>
</header>
--}}
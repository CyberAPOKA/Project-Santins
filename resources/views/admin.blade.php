@extends('layouts.master')
@section('content')

@if(session('universidadeStatus'))
  <script>
    Swal.fire({
  position: 'mid-mid',
  icon: 'success',
  title: 'Status alterado com Sucesso!',
  showConfirmButton: false,
  timer: 2000
})
  </script>
 @endif

@if(session('subscriptionExist'))
  <script>
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Você já se inscreveu nessa universidade!',

})
  </script>
 @endif

@if(session('subscriptionExist'))
  <script>
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Você já está inscrito nessa universidade!',

})
  </script>
 @endif


@if(session('subscription'))
  <script>
    Swal.fire({
  position: 'mid-mid',
  icon: 'success',
  title: 'Inscrição feita com sucesso!',
  showConfirmButton: false,
  timer: 2000
})
  </script>
 @endif

@if(session('success'))
  <script>
    Swal.fire({
  position: 'mid-mid',
  icon: 'success',
  title: 'Universidade sugerida com sucesso!',
  showConfirmButton: false,
  timer: 2000
})
  </script>
 @endif
  <div class="text-center">
  <h1 style="color: black">SUPER ADMINISTRADOR</h1>
</div>
    <section class="universidades">
        <div class="container-fluid">
                <form action="{{ route('universidades.search') }}" method="POST">
                @csrf
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-6">
                    <input type="text" id="search" name="search" class="form-control form-control-lg" placeholder="Search">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary form-control-lg">Search</button>
                        </form>
                            <button type="button" class="btn btn-danger form-control-lg">
                                <a href="{{route('universidades.search')}}" class="a-button">
                                    Reset
                                </a>
                            </button>

                            <button type="button" class="btn btn-primary form-control-lg">
                                <a href="{{route('universidades.create')}}" class="a-button">
                                    Create University
                                </a>
                            </button>

                            <button type="button" class="btn btn-primary form-control-lg">
                                <a href="{{route('universidades.subscribe')}}" class="a-button">
                                    My Subscriptions
                                </a>
                            </button>

                            @if($role == '1')
                            <button type="button" class="btn btn-primary form-control-lg">
                                <a href="{{route('universidades.index')}}" class="a-button">
                                   Universidades
                                </a>
                            </button>
                            @endif


                        </div>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Alpha two code</th>
                        <th scope="col">Country</th>
                        <th scope="col">Domains</th>
                        <th scope="col">Name</th>
                        <th scope="col">Web pages</th>
                        <th scope="col">
                            0 = Aprovadas
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                          @foreach ($universidades as $universidade)
                        <tr>
                            <td>{{$universidade->id}}</td>
                            <td>{{$universidade->alpha_two_code}}</td>
                            <td>{{$universidade->country}}</td>
                            <td>{{json_encode($universidade->domains)}}</td>
                            <td>{{$universidade->name}}</td>
                            <td>{{json_encode($universidade->web_pages)}}</td>
                            <td>
                                <form method="post" action="{{route('universidades.status', $universidade->id)}}">
                                    @csrf

                                                <select class="form-control" id="status" name="status">
                                                    <option value="{{$universidade->status}}">{{$universidade->status}}</option>
                                                    @if($universidade->status == 0)
                                                    <option value="{{1}}">{{1}}</option>
                                                        @else
                                                        <option value="{{0}}">{{0}}</option>
                                                        @endif
                                                </select>

                                                <button type="submit" class="form-control" name="subscribe">
                                                        Confirmar
                                                </button>

                                </form>
                            </td>
                        </tr>
                          @endforeach

                    </tbody>
                  </table>
                  @if (isset($filters))
                  {{ $universidades->appends($filters)->links() }}
                  @else
                  {{ $universidades->links() }}
                  @endif

                  Showing {{ $universidades->firstItem() }} to {{ $universidades->lastItem() }}
                  of total {{$universidades->total()}} entries

        </div>

    </section>

@endsection


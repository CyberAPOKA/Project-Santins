@extends('layouts.master')
@section('content')

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
                        <th scope="col">INSCREVER-SE</th>
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
                                @if ($universidade->status == 0)
                                <form method="post" action="{{route('subscription.store')}}">
                                    @csrf
                                    <button type="submit" class="subscribe-button" name="subscribe"
                                     value="{{ $universidade->name }}">
                                            INSCREVER-SE
                                    </button>
                                </form>
                                @else
                                Aguardando aprovação
                                @endif
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


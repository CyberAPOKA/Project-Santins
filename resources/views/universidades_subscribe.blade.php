@extends('layouts.master')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="">

            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">My subscriptions</th>
                    <th scope="col">Remove</th>
                  </tr>
                </thead>
                <tbody>

                      @foreach ($subscribe as $sub)
                    <tr>
                        <td>{{$sub->universidade_name}}</td>
                        <td>
                            <form action="{{route('subscription.remove', $sub->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                    <button type="submit" class="subscribe-button">Remover</button>
                               </form>
                        </td>
                    </tr>
                      @endforeach

                </tbody>
              </table>

        </div>
    </div>
</div>

@endsection

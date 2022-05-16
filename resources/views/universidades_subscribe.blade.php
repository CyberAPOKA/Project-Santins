@extends('layouts.master')
@section('content')

@if(session('subscriptionDelete'))
  <script>
    Swal.fire({
  position: 'mid-mid',
  icon: 'success',
  title: 'Inscrição removida com Sucesso!',
  showConfirmButton: false,
  timer: 1500
})
  </script>
 @endif

<div class="container">

    <div class="col-md-12">
        <div class="">
            <h1><a style="color: #fe0575; text-decoration: none" href="{{route('universidades.index')}}">Voltar</a></h1>
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
                            <form action="{{route('subscription.remove', $sub->id)}}" method="POST" id="deleteSubscription">
                                @method('DELETE')
                                @csrf
                                    <button type="submit" class="subscribe-button delete" onclick="deleteSubscription(this)">Remover</button>
                               </form>
                        </td>
                    </tr>
                      @endforeach

                </tbody>
              </table>

        </div>
    </div>
</div>

<script>
    function deleteSubscription(){
   event.preventDefault();
   var form = event.target.form;
        Swal.fire({
 title: 'Você deseja realmente excluir este usuário?',
 text: "Após a exclusão, os dados não poderão ser recuperados!",
 icon: 'warning',
 showCancelButton: true,
 confirmButtonColor: '#d33',
 cancelButtonColor: '#3085d6',
 confirmButtonText: 'Sim, Excluir!',
 cancelButtonText: 'Cancelar',
}).then((result) => {
 if (result.isConfirmed) {
    form.submit();
 }
});

    }
</script>

@endsection

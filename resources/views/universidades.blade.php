@extends('layouts.master')
@section('content')
    @if (session('deleteUniversidades'))
        <script>
            Swal.fire({
                position: 'mid-mid',
                icon: 'success',
                title: 'University successfully deleted!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('subscriptionExist'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You have already applied to this university!',

            })
        </script>
    @endif

    @if (session('subscription'))
        <script>
            Swal.fire({
                position: 'mid-mid',
                icon: 'success',
                title: 'Enrollment successful!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                position: 'mid-mid',
                icon: 'success',
                title: 'University successfully registered! wait until approval.',
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif

    <section class="universidades">
        </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    @if ($user->role == 1)
                        <th scope="col">ID</th>
                    @endif
                    <th scope="col">Alpha-2 code</th>
                    <th scope="col">Country</th>
                    <th scope="col">Domains</th>
                    <th scope="col">Name</th>
                    <th scope="col">Web pages</th>
                    @if ($user->role == 0)
                        <th scope="col">SIGN UP</th>
                    @else
                        <th scope="col">Delete</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($universidades as $universidade)
                    <tr>
                        @if ($user->role == 1)
                            <td>{{ $universidade->id }}</td>
                        @endif
                        <td>{{ $universidade->alpha_two_code }}</td>
                        <td>{{ $universidade->country }}</td>
                        <td>
                         
                            @foreach ((array)$universidade->domains as $domain)
                                {{ $domain }}
                            @endforeach
                        </td>
                        <td>{{ $universidade->name }}</td>
                        <td>
                            @foreach ((array)$universidade->web_pages as $web_page)
                                <a href="{{ $web_page }}" class="web_page" target="_blank">{{ $web_page }}</a>
                            @endforeach
                        </td>
                        <td>
                            @if ($universidade->status == 0 && $user->role == 0)
                                <form method="post" action="{{ route('subscription.store') }}">
                                    @csrf
                                    <input hidden type="text" name="subscribe" value="{{ $universidade->id }}">
                                    <input hidden type="text" name="subscribe2" value="{{ $universidade->name }}">

                                    <button type="submit" class="subscribe-button">
                                        SIGN UP
                                    </button>

                                </form>
                            @elseif ($user->role == 1)
                                <form method="POST" action="{{ route('universidades.delete', $universidade->id) }}"
                                    id="deleteUniversidade">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="subscribe-button delete" onclick="deleteUniversidade(this)">
                                        DELETE
                                    </button>

                                </form>
                            @else
                                Waiting for approval
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

        <div class="showing">
            Showing {{ $universidades->firstItem() }} to {{ $universidades->lastItem() }}
            of total {{ $universidades->total() }} entries
        </div>
        </div>

    </section>


    <script>
        function deleteUniversidade() {
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                title: 'Você deseja realmente excluir esta universidade?',
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

@extends('layouts.master')
@section('content')
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

                            @foreach ((array) $universidade->domains as $domain)
                                {{ $domain }}
                            @endforeach
                        </td>
                        <td>{{ $universidade->name }}</td>
                        <td>
                            @foreach ((array) $universidade->web_pages as $web_page)
                                <a href="{{ $web_page }}" class="web_page"
                                    onclick="followLink(event)" target="_blank">
                                    {{ $web_page }}</a>
                            @endforeach
                        </td>
                        <td>
                            @if ($universidade->status == 0 && $user->role == 0)
                                <form method="post" action="{{ route('subscription.store') }}">
                                    @csrf
                                    <input hidden type="text" name="subscribe" value="{{ $universidade->id }}">
                                    <input hidden type="text" name="subscribe2" value="{{ $universidade->name }}">

                                    @if ($subscriptions->contains($universidade->id))
                                        <h6>Pending registration</h6>
                                    @else
                                        <button type="submit" class="subscribe-button">
                                            SIGN UP
                                        </button>
                                    @endif

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
                                <h6>Waiting for approval</h6>
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

        <div class="row">
            <div class="col-md-6">
                <div class="showing">
                    Showing {{ $universidades->firstItem() }} to {{ $universidades->lastItem() }}
                    of total {{ $universidades->total() }} entries
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <button type="button" class="reset-search" onclick="resetSearch(this)">
                        <a href="{{ route('universidades.search') }}">RESET SEARCH</a>
                    </button>

                </div>

            </div>
        </div>

        </div>

    </section>

    <script>
        function resetSearch() {
            event.preventDefault();
            Swal.fire({
                title: 'The search filter will be lost!',
                text: "Do you wish to continue?",
                icon: 'warning',
                iconColor: '#ff0000',
                showCancelButton: true,
                confirmButtonColor: '#ff0000',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Reset!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('universidades.search')}}";
                }
            });

        }
    </script>



    <script>
        function followLink(e) {
            event.preventDefault();
            Swal.fire({
                title: 'You clicked on a link and you will be redirected!',
                text: "Are you sure you want to continue?",
                icon: 'warning',
                iconColor: '#ff0000',
                showCancelButton: true,
                confirmButtonColor: '#ff0000',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, go'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = e.target.href;
                }
            })
        }
    </script>
@endsection

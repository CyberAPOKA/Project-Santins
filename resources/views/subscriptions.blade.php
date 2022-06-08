@extends('layouts.master')
@section('content')
    @if (session('subscriptionDelete'))
        <script>
            Swal.fire({
                position: 'mid-mid',
                icon: 'success',
                title: 'Enrollment Successfully Removed!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    <section class="universidades">
        </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">University ID</th>
                    <th scope="col">University Name</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($subscriptions as $sub)
                    <tr>
                        <td>{{ $sub->user_id }}</td>
                        <td>{{ $sub->user_name }}</td>
                        <td>{{ $sub->universidade_id }}</td>
                        <td>{{ $sub->universidade_name }}</td>
                        <td>
                            <form action="{{ route('subscription.remove', $sub->id) }}" method="POST"
                                id="deleteSubscription">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="subscribe-button delete"
                                    onclick="deleteEnrollment(this)">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        @if (isset($filters))
            {{ $subscriptions->appends($filters)->links() }}
        @else
            {{ $subscriptions->links() }}
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="showing">
                    Showing {{ $subscriptions->firstItem() }} to {{ $subscriptions->lastItem() }}
                    of total {{ $subscriptions->total() }} entries
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <button type="button" class="reset-search" onclick="resetSearch(this)">
                        <a href="{{ route('universidades.searchEnrollments') }}">RESET SEARCH</a>
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
                    window.location.href = "{{ route('universidades.searchEnrollments') }}";
                }
            });

        }
    </script>

    <script>
        function deleteEnrollment() {
            event.preventDefault();
            var form = event.target.form;
            Swal.fire({
                title: 'Do you really want to delete this enrollment?',
                text: "The user will be unlinked from this university!",
                icon: 'warning',
                iconColor: '#ff0000',
                showCancelButton: true,
                confirmButtonColor: '#ff0000',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        }
    </script>
@endsection

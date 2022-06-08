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
    @if (session('universidadeStatus'))
        <script>
            Swal.fire({
                position: 'mid-mid',
                icon: 'success',
                title: 'Status Changed Successfully!',
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
                text: 'You are already enrolled in this university!',

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
                title: 'University suggested successfully!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
    <section class="universidades">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Alpha-2 code</th>
                    <th scope="col">Country</th>
                    <th scope="col">Domains</th>
                    <th scope="col">Name</th>
                    <th scope="col">Web pages</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($universidades as $universidade)
                    <tr>
                        <td>{{ $universidade->id }}</td>
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
                            <form method="post" action="{{ route('universidades.status', $universidade->id) }}"
                                id="form" name="form">
                                @csrf

                                @if ($universidade->status == 0)
                                    <select class="form-control biri" id="status" name="status" onchange="this.form.submit()" 
                                        style="background-color: rgb(87, 168, 32); color: white">
                                    @else
                                        <select class="form-control biri" id="status" name="status" onchange="this.form.submit()"
                                        style="background-color: red; color: white">
                                @endif
                                <option value="{{ $universidade->status }}" class="approve">
                                    @if ($universidade->status == 0)
                                        <div class="">
                                            Approved <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                        @else
                                        <div>
                                            Not approved <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    @endif
                                </option>

                                @if ($universidade->status == 0)
                                    <option value="{{ 1 }}" class="repprove">Reprove </option>
                                @else
                                    <option value="{{ 0 }}" class="approve">Approve</option>
                                @endif
                                </select>

                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('universidades.delete', $universidade->id) }}"
                                id="deleteUniversidade">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="subscribe-button delete" onclick="deleteUniversidade(this)">
                                    DELETE
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
                title: 'Do you really want to delete this university?',
                text: "After deletion, data cannot be recovered!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
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

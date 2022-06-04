@extends('layouts.master')
@section('content')
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
                    <th scope="col">Alpha two code</th>
                    <th scope="col">Country</th>
                    <th scope="col">Domains</th>
                    <th scope="col">Name</th>
                    <th scope="col">Web pages</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($universidades as $universidade)
                    <tr>
                        <td>{{ $universidade->id }}</td>
                        <td>{{ $universidade->alpha_two_code }}</td>
                        <td>{{ $universidade->country }}</td>
                        <td>{{ json_encode($universidade->domains) }}</td>
                        <td>{{ $universidade->name }}</td>
                        <td>{{ json_encode($universidade->web_pages) }}</td>
                        <td>
                            <form method="post" action="{{ route('universidades.status', $universidade->id) }}">
                                @csrf

                                <select class="form-control" id="status" name="status">
                                    <option value="{{ $universidade->status }}" class="approve">
                                      @if( $universidade->status == 0)
                                      <div class="approve">
                                        Approved @else
                                      </div>
                                      <div class="reprove">
                                        Reproved 
                                      </div>
                                      @endif</option>

                                    @if ($universidade->status == 0)
                                        <option value="{{ 1 }}"  class="approve">Reprove</option>
                                    @else
                                        <option value="{{ 0 }}"  class="approve">Approve</option>
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
        <div class="showing">
            Showing {{ $universidades->firstItem() }} to {{ $universidades->lastItem() }}
            of total {{ $universidades->total() }} entries
        </div>
        </div>

    </section>
@endsection

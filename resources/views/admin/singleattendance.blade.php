@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Attendance Report of: ' . $user_name) }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form action="{{ route('employee.add') }}" method="GET">

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Employee') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <br>

                        <form action="{{ route('home') }}" method="GET">
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Back to Home') }}
                                    </button>
                                </div>
                            </div>
                        </form>



                    </div>
                    



                    {{-- owner: table of registered employees --}}

                    <div class="container">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th scope="col">Date</th>
                                        <th scope="col">Check in</th>
                                        <th scope="col">Check Out</th>
                                        <th scope="col">Office Hour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($user_data as $item)
                                        <tr>
                                            
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->check_in }}</td>
                                            <td>
                                                @if ($item->check_out)
                                                    {{ $item->check_out }}
                                                @else

                                                    <div style="color: red; font-weight: bolder">
                                                        Not checked out yet!
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->spent_hours }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Table ends --}}
                    {{ $user_data->links() }}

    </div>
@endsection

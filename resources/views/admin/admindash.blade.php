@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Owner Dashboard') }}
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

                        <form action="{{ route('owner.attendace') }}" method="GET">
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('All Attendance') }}
                                    </button>
                                </div>
                            </div>
                        </form>



                    </div>



                    {{-- owner: table of registered employees --}}

                    <div class="container">
                        <div class="row">
                            <table class="table">
                                <span style="color: red; font-weight: bold">*** Click on an Employee name to see their single Attendance-Report</span>
                                <thead>
                                    <tr>
                                        <th scope="col">SL No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>
                                                {{-- check if it is not owner --}}
                                                @if ($user->is_owner === 1)
                                                    {{ $user->name }}
                                                @else
                                                    <a href="{{ url('owner/single/attendance/' . $user->id) }}">
                                                        {{ $user->name }}
                                                    </a>
                                                @endif


                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->is_owner == 1)
                                                    Owner
                                                @else
                                                    Employee
                                                @endif
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                            </td>
                                            <!-- Carbon\Carbon::parse only for query builder method  -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Table ends --}}

                </div>
            </div>
        </div>
    </div>
@endsection

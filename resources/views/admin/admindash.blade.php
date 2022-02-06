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



                        <div class="row">
                            <a href="{{ route('owner.home') }}">
                                {{ __('List of employees') }}
                            </a>
                            <a href="{{ route('employee.add') }}">
                                {{ __('Add New Employee') }}
                            </a>
                        </div>

                    </div>



                    {{-- owner: table of registered employees --}}

                    <div class="container">
                        <div class="row">
                            <table class="table">
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
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->is_owner==1)
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

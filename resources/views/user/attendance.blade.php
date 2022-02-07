@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Attendance Page') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ $date }}

                        @if ($created !== null)
                            {{-- checked in already!! --}}
                            <form action="{{ route('employee.check.out') }}" method="POST">
                                @csrf
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Check Out') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        @else
                            {{-- not checked in yet!! --}}
                            <form action="{{ route('employee.check.in') }}" method="POST">
                                @csrf
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Check In') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        @endif

                        <br>

                        <br>

                        <br>
                        {{-- __status:
                        {{ $created }}

                        <br>
                        __result:
                        {{ $result }} --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

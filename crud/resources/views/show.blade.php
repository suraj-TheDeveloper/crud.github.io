@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach ($showtask as $task)
                    <form action="{{ route('update', $task->id) }}" method="POST">
                        @csrf
                        <div class="mt-3 mb-3">
                            <label class="form-label">Task Name</label>
                            <input type="text" name="name" id="name" value="{{ $task->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Task Name..">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-3 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Task Description.." rows="5">{{ $task->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-3 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" id="sdate" name="sdate" value="{{ $task->sdate }}" class="form-control @error('sdate') is-invalid @enderror">
                            @error('sdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-3 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" id="edate" name="edate" value="{{ $task->edate }}" class="form-control @error('edate') is-invalid @enderror ">
                            @error('edate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-3 mb-3">
                            <label class="form-label">Status</label>
                            <input type="checkbox" class="form-check-input" name="status" value="{{ $task->status }}" id="status" {{ old('status', $task->status) ? 'checked' : '' }}>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Task') }}
                                </button><br>
                                <a class="btn btn-link" href="{{ route('home') }}">
                                    {{ __('Go to home') }}
                                </a>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        const status = document.querySelector("#status");
        status.addEventListener("click", function(){
            var complete = document.getElementById("status").value;
            if(complete == 0) {
                document.getElementById("status").setAttribute("value", "1");
            } else {
                document.getElementById("status").setAttribute("value", "0");
            }
        });
    </script>
@endsection

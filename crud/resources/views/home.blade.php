@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="{{ route('create_form') }}"><button class="btn btn-primary">{{ __('Create Task') }}</button></a>
                        </div>
                        <div class="col-md-6">
                            {{ __('Task List') }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($showdata as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ $task->sdate }}</td>
                                        <td>{{ $task->edate }}</td>
                                        <td>
                                            @if ($task->status == 1)
                                                <input type="checkbox" onclick="update({{ $task->id }}, {{ $task->status }})" name="status" id="status" checked>
                                            @else
                                                <input type="checkbox" onclick="update({{ $task->id }}, {{ $task->status }})" name="status" id="status">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('display', $task->id) }}"><button class="btn btn-info">Edit</button></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('delete', $task->id) }}"><button class="btn btn-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function update(id, status) {
        console.log(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("status") }}',
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'html',
            data: {
                id: id,
                status: status,
            },
            success: function(data) {
                console.log(data);
            }
        });
    }
</script>
@endsection

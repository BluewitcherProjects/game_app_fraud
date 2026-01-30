@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <a href="{{ route('admin.invite.task.create') }}" class="btn btn-success mb-3 mt-2">Create New Task</a>

                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>Referral Count</th>
                                    <th>Reward Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->referral_count }}</td>
                                        <td>{{ $general->cur_sym }}{{ $task->reward_amount }}</td>
                                        <td>
                                            <a href="{{ route('admin.invite.task.edit', $task) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.invite.task.destroy', $task) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($tasks) }}
                </div>
            </div>
        </div>


    </div>
@endsection

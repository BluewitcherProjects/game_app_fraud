@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <h2>Create Invite Task</h2>

                    <form method="POST" action="{{ route('admin.invite.task.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Referral Count</label>
                            <input type="number" name="referral_count" class="form-control"
                                value="{{ old('referral_count', $task->referral_count ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Reward Amount</label>
                            <input type="number" step="0.01" name="reward_amount" class="form-control"
                                value="{{ old('reward_amount', $task->reward_amount ?? '') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Task</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection

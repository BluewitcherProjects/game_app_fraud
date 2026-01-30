@extends('admin.layouts.app')


@section('panel')
    <div class="row">
        <div class="col-xl-12">
            <div class="card b-radius--10 ">
                <div class="card-body">

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>@lang('Messages')</label>
                                        <textarea rows="2" class="form-control message-box" name="message"></textarea>
                                    </div>



                                    {{--<div class="form-group">

                                        <div class="btn-group">



                                            <a href="#" class="btn btn-success btn-action" data-action="recharge">Deposit</a>

                                            <a href="#" class="btn btn-warning btn-action" data-action="withdraw-approved">Withdrawal Approved</a>



                                        </div>

                                    </div>--}}

                                </div>

                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <button type="submit" class="btn btn-block btn--primary mr-2">@lang('Send')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
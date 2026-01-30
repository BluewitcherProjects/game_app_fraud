@extends('admin.layouts.app')
@section('panel')

    

    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">


                    <div class="" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">@lang('Generate Gift Code')</h5>
                                    
                                </div>

                                <div id="alert-message" class="alert d-none"></div>

                                <form action="" method="post">
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="amount">@lang('Amount')</label>
                                                    <input type="number" name="amount" class="form-control" id="name"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="quantity">@lang('Quantity')</label>
                                                    <input type="number" name="quantity" class="form-control" id="quantity"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="quantity">@lang('Redeem Count')</label>
                                                    <input type="number" name="redeem_count" class="form-control" id="quantity"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn--primary">@lang('Generate Code')</button>
                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection

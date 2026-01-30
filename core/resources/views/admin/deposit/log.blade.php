@extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        @if(request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.users.deposits') || request()->routeIs('admin.users.deposits.method'))
            <div class="col-md-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--success">
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($successful) }}</h2>
                        <p class="text-white">@lang('Successful Deposit')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-md-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--6">
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($pending) }}</h2>
                        <p class="text-white">@lang('Pending Deposit')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-md-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--pink">
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($rejected) }}</h2>
                        <p class="text-white">@lang('Rejected Deposit')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            @php
                $item = getshpaybank();
            @endphp
            <div class="col-md-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--success">
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($shpay) }}</h2>
                        <p class="text-white">@lang('SHPAY Available balance')</p>
                    </div>
                    <form action="{{ url('shpay/withdraw') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <p style="margin-bottom: 10px;">
                                        <select name="bank_code" id="bank_name" required>
                                        <option value="">Select</option>
                                        @foreach ($item['result'] as $bank)
                                            <option value="{{ $bank['bankCode'] }}">{{ $bank['bankName'] }}</option>
                                            
                                        @endforeach
                                        </select>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <p style="margin-bottom: 10px;">
                                <input type="number" placeholder="Account Number" name="account_number" required>
                            </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <p style="margin-bottom: 10px;">
                                <input type="text" placeholder="Account Name" name="account_name" required>
                            </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <p style="margin-bottom: 10px;">
                                <input type="number" placeholder="Amount" name="amount" required>
                            </p>
                            </div>
                        </div>
                        <button type="submit" style="padding:10px 20px; background: darkgreen; color:white;" type="submit">Cashout</button>
                    </form>
                </div><!-- widget-two end -->
            </div>
        @endif

        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('Gateway | Trx')</th>
                                <th>@lang('Initiated')</th>
                                <th>@lang('User')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Sender')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($deposits as $deposit)
                                @php
                                    $details = $deposit->detail ? json_encode($deposit->detail) : null;
                                @endphp
                                <tr>
                                    <td data-label="@lang('Gateway | Trx')">
                                        <span class="font-weight-bold"> <a
                                                    href="{{ route('admin.deposit.method',[$deposit->gateway->alias,'all']) }}">{{ __($deposit->gateway->name) }}</a> </span>
                                        <br>
                                        <small> {{ $deposit->trx }} </small>
                                    </td>

                                    <td data-label="@lang('Date')">
                                        {{ showDateTime($deposit->created_at) }}
                                        <br>{{ diffForHumans($deposit->created_at) }}
                                    </td>
                                    <td data-label="@lang('User')">
                                        <span class="font-weight-bold">{{ $deposit->user->fullname }}</span>
                                        <br>
                                        <span class="small">
                                    <a href="{{ route('admin.users.detail', $deposit->user_id) }}"><span>@</span>{{ $deposit->user->username }}</a>
                                    </span>

                                        @if($deposit->status == 2)

                                            <form action="{{route('admin.deposit.approve')}}" method="POST"
                                                  class="form-inline" style="display: inline-block">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $deposit->id }}">

                                                <button type="submit" class="btn btn--success">@lang('Approve')</button>

                                            </form>


                                            <br><br>


                                            <form action="{{ route('admin.deposit.reject')}}" method="POST"
                                                  onsubmit="return confirm('Are you sure?')" class="form-inline"
                                                  style="display: inline-block">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $deposit->id }}">


                                                <button type="submit" class="btn btn--danger">@lang('Reject')</button>

                                                <button type="submit" name="block" value="1"
                                                        class="btn btn--danger">@lang('Reject and Block')</button>
                                            </form>

                                        @endif

                                    </td>
                                    <td data-label="@lang('Amount')">
                                        {{ __($general->cur_sym) }}{{ showAmount($deposit->amount ) }} + <span
                                                class="text-danger" data-toggle="tooltip"
                                                data-original-title="@lang('charge')">{{ showAmount($deposit->charge)}} </span>
                                        <br>
                                        <strong data-toggle="tooltip" data-original-title="@lang('Amount with charge')">
                                            {{ showAmount($deposit->amount+$deposit->charge) }} {{ __($general->cur_text) }}
                                        </strong>
                                    </td>
                                    <td data-label="@lang('Conversion')">
                                        <strong>Naration</strong>
                                        <small> {{ $deposit->trx }} </small>

                                        @if($details != null)
                                            @foreach(json_decode($details) as $k => $val)
                                                @if($deposit->method_code >= 1000)
                                                    @if($val->type == 'file')
                                                        <div class="row mt-4">
                                                            <div class="col-md-8">
                                                                <h6>{{inputTitle($k)}}</h6>
                                                                <img src="{{getImage('assets/images/verify/deposit/'.$val->field_name)}}" alt="@lang('Image')">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row mt-4">
                                                            <div class="col-md-12">
                                                                <h6>{{inputTitle($k)}}</h6>
                                                                <p>{{__($val->field_name)}}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($deposit->status == 2)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($deposit->status == 1)
                                            <span class="badge badge--success">@lang('Approved')</span>
                                            <br>{{ diffForHumans($deposit->updated_at) }}
                                        @elseif($deposit->status == 3)
                                            <span class="badge badge--danger">@lang('Rejected')</span>
                                            <br>{{ diffForHumans($deposit->updated_at) }}
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">


                                        <a href="{{ route('admin.deposit.details', $deposit->id) }}"
                                           class="icon-btn ml-1 " data-toggle="tooltip" title=""
                                           data-original-title="@lang('Detail')">
                                            <i class="la la-desktop"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($deposits) }}
                </div>
            </div><!-- card end -->
        </div>
    </div>


@endsection


@push('breadcrumb-plugins')
    @if(!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method'))
        <form action="{{route('admin.deposit.search', $scope ?? str_replace('admin.deposit.', '', request()->route()->getName()))}}"
              method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
            <div class="input-group has_append  ">
                <input type="text" name="search" class="form-control" placeholder="@lang('Trx number/Username')"
                       value="{{ $search ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <form action="{{route('admin.deposit.dateSearch',$scope ?? str_replace('admin.deposit.', '', request()->route()->getName()))}}"
              method="GET" class="form-inline float-sm-right bg--white">
            <div class="input-group has_append ">
                <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en"
                       class="datepicker-here form-control" data-position='bottom right'
                       placeholder="@lang('Min date - Max date')" autocomplete="off" value="{{ @$dateSearch }}">
                <input type="hidden" name="method" value="{{ @$methodAlias }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

    @endif
@endpush


@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            }
        })(jQuery)
    </script>
@endpush

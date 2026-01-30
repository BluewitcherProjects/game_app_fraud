@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Content')</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($proof as $data)
                                <tr>
                                    <td data-label="@lang('Name')">
                                    <span class="font-weight-bold">
                                        {{ __($data->user->mobile) }}
                                    </span>
                                    </td>


                                    <td>
                                        {{ $data->content }}
                                    </td>

                                    <td >
                                        @php
                                            $images = json_decode($data->image, true); // Decode the JSON
                                        @endphp
                                        @foreach ($images as $image)
                                         <a href="{{ asset('core/storage/app/public/' . $image) }}">
                                             <img style="width:40px;" src="{{ asset('core/storage/app/public/' . $image) }}" draggable="false">
                                         </a>
                                         @endforeach
                                    </td>

                                    <td data-label="@lang('Status')">
                                        @if($data->status == 2)
                                            <span class="badge badge--warning">
                                            @lang('Pending')
                                        </span>
                                        @elseif($data->status == 1)
                                        <span class="badge badge--success">
                                            @lang('Approved')
                                        </span>
                                        @else
                                            <span class="badge badge--danger">
                                            @lang('Failed')
                                        </span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.proof.approve', $data->id) }}"

                                           class="icon-btn editBtn btn--success"
                                           data-original-title="@lang('Approve')"
                                        >
                                            Approve
                                        </a>
                                        
                                        &nbsp;
                                        
                                        <a href="{{ route('admin.proof.reject',$data->id) }}"

                                           class="icon-btn editBtn btn--danger"
                                           data-original-title="@lang('Reject')"
                                        >
                                            Reject
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
                    {{ paginateLinks($proof) }}
                </div>
            </div>
        </div>

    </div>



    

@endsection

@push('breadcrumb-plugins')
    
@endpush

@push('script')
    
@endpush

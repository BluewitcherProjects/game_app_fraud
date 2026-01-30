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
                                <th>@lang('Tilte')</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Url')</th>
                                <th>@lang('Descr')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($plan as $data)
                                <tr>
                                    <td data-label="@lang('Title')">
                                    <span class="font-weight-bold">
                                        {{ __($data->title) }}
                                    </span>
                                    </td>

                                    <td data-label="@lang('Image')">
                                        <img src="{{ getImage(imagePath()['gateway']['path'] .'/'. $data->image) }}" width="100">
                                    </td>

                                    <td data-label="@lang('Url')">
                                        {{ $data->url }}
                                    </td>

                                    <td data-label="@lang('Descr')">
                                        {{ nl2br($data->descr) }}
                                    </td>

                                    <td data-label="@lang('Status')">
                                        @if($data->status == 0)
                                            <span class="badge badge--danger">
                                            @lang('Disable')
                                        </span>
                                        @else
                                            <span class="badge badge--success">
                                            @lang('Enable')
                                        </span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Action')">
                                        <a href="#0"

                                           data-id='{{ $data->id }}'
                                           data-title='{{ $data->title }}'
                                           data-descr='{{ $data->descr }}'
                                           data-url='{{ $data->url }}'
                                           data-status='{{ $data->status }}'

                                           class="icon-btn editBtn"
                                           data-toggle="tooltip"
                                           title="@lang('Edit')"
                                           data-original-title="@lang('Edit')"
                                        >
                                            <i class="las la-edit text--shadow"></i>
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
                    {{ paginateLinks($plan) }}
                </div>
            </div>
        </div>

    </div>

    {{-- ADD METHOD MODAL --}}
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add New Task')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tasks.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="file">@lang('Picture')</label>
                                    <input type="file" name="image" class="form-control" id="image" required>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">@lang('Title')</label>
                                    <input type="text" name="title" class="form-control" id="name" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="descr">@lang('Description')</label>
                                    <textarea type="text" name="descr" class="form-control" id="descr" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="url">@lang('Link')</label>
                                    <input type="url" name="url" class="form-control" id="url" required placeholder="http://">
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="status">@lang('Status')</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1">@lang('Enable')</option>
                                        <option value="0">@lang('Disable')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ADD METHOD MODAL --}}
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Task')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tasks.edit') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" required>

                    <div class="modal-body">


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">@lang('Title')</label>
                                    <input type="text" name="title" class="form-control" id="name" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="descr">@lang('Description')</label>
                                    <textarea type="text" name="descr" class="form-control" id="descr" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="url">@lang('Link')</label>
                                    <input type="url" name="url" class="form-control" id="url" required placeholder="http://">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="edit_status">@lang('Status')</label>
                                    <select name="status" id="edit_status" class="form-control" required>
                                        <option value="1">@lang('Enable')</option>
                                        <option value="0">@lang('Disable')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text-white text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush

@push('script')
    <script>
        (function ($) {

            "use strict";

            $('.addBtn').on('click', (e)=> {
                var modal = $('#addModal');
                modal.modal('show');
            });

            $('#interest_type').on('change', (e)=>{
                var $this = e.currentTarget;

                var result = null;

                if($this.value == 0){
                    result = '{{ __($general->cur_text) }}';
                }else{
                    result = '%';
                }

                $('#change_interest_symbol').text(result);

            });

            $('#edit_interest_type').on('change', (e)=>{
                var $this = e.currentTarget;

                var result = null;

                if($this.value == 0){
                    result = '{{ __($general->cur_text) }}';
                }else{
                    result = '%';
                }

                $('#update_interest_symbol').text(result);

            });

            $('.editBtn').on('click', (e)=> {
                var $this = $(e.currentTarget);
                var modal = $('#editModal');



                modal.find('input[name=id]').val($this.data('id'));
                modal.find('input[name=title]').val($this.data('title'));
                modal.find('input[name=url]').val($this.data('url'));
                modal.find('textarea[name=descr]').val($this.data('descr'));
                modal.find('select[name=status]').val($this.data('status'));

                modal.modal('show');
            });

        })(jQuery);

    </script>
@endpush

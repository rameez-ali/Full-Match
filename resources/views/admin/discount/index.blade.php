@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l12">
                        @if ($discountaddsuccess = Session::get('discountaddsuccess'))
                            <div class="card-alert card gradient-45deg-green-teal">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">check</i>{{ $discountaddsuccess }}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif($discounteditsuccess = Session::get('discounteditsuccess'))
                            <div class="card-alert card gradient-45deg-green-teal">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">check</i>{{ $discounteditsuccess }}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif($discountdeletesuccess = Session::get('discountdeletesuccess'))
                            <div class="card-alert card gradient-45deg-green-teal">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">check</i>{{ $discountdeletesuccess }}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <div class="card animate fadeUp">
                            <div class="card-content">
                                <h4 class="header mt-0">
                                    {{ __('customer.discount.discount_section') }}
                                    <a href="{{ route('discount.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right"> {{ __('customer.add') }}</a>
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <table id="page-length-option" class="display">
                                            <thead>
                                            <tr>
                                                <th>{{ __('customer.id') }}</th>
                                                <th>{{ __('customer.title') }}</th>
                                                <th>{{ __('customer.discount.discount_type') }}</th>
                                                <th>{{ __('customer.code') }}</th>
                                                <th>{{ __('customer.value') }}</th>
                                                <th>{{ __('customer.start_date') }}</th>
                                                <th>{{ __('customer.end_date') }}</th>
                                                <th>{{ __('customer.status') }}</th>
                                                <th>{{ __('customer.action') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($discounts as $discount)
                                                <tr>
                                                    <td>{{ $discount->id }}</td>
                                                    <td>{{ $discount->title }}</td>
                                                    <td>{{ $discount->type }}</td>
                                                    <td>{{ $discount->code }}</td>
                                                    <td>{{ $discount->value }}</td>
                                                    <td>{{ $discount->start_date }}</td>
                                                    <td>{{ $discount->end_date }}</td>
                                                    <td>{{ $discount->status }}</td>
                                                    <td>
                                                        <a class="mb-5 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="{{ route('discount.edit',[ 'discount' => $discount->id ]) }}">{{ __('customer.customer.edit') }}</a>
                                                        <a class="mb-5 btn waves-effect waves-light gradient-45deg-amber-amber" onclick="deletePlan({{ $discount->id }})" href="#">{{ __('customer.delete') }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>{{ __('customer.id') }}</th>
                                                <th>{{ __('customer.title') }}</th>
                                                <th>{{ __('customer.discount.discount_type') }}</th>
                                                <th>{{ __('customer.code') }}</th>
                                                <th>{{ __('customer.value') }}</th>
                                                <th>{{ __('customer.start_date') }}</th>
                                                <th>{{ __('customer.end_date') }}</th>
                                                <th>{{ __('customer.status') }}</th>
                                                <th>{{ __('customer.action') }}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <form id="delete-form" method="POST" style="display:none">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
@endsection
@section('scripts')

    <script src={{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}></script>
    <script src={{ asset('app-assets/vendors/data-tables/js/dataTables.select.min.js') }}></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <style type="text/css">
        div.dt-buttons {
            margin-bottom:20px;
        }

    </style>
    <script type="text/javascript">
        function deletePlan(id){
            let confirmBox = confirm('{{ __("customer.delete_message") }}');

            if(confirmBox){
                let path = `{{ url('discount/${id}') }}`;
                $('#delete-form').attr('action',path);
                $('#delete-form').submit();
            }
        }

        $(document).ready(function(){

            $('#page-length-option').DataTable({
                "responsive": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    {
                        extend: 'excel',
                        text: '{{ __("customer.excel") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.excel") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5,6 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.csv") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5,6 ]
                        },
                    }
                ],
                dom: 'Blfrtip',
            });
        });
    </script>
@endsection

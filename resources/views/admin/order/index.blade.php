@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card animate fadeUp">
                            <div class="card-content">
                                <h4 class="header mt-0">
                                    {{ __('customer.order.orderpage_section') }}
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <table id="page-length-option" class="display">
                                            <thead>
                                            <tr>
                                                <th>{{ __('customer.order.uname') }}</th>
                                                <th>{{ __('customer.order.uemail') }}</th>
                                                <th>{{ __('customer.order.umobile') }}</th>
                                                <th>{{ __('customer.order.order_num') }}</th>
                                                <th>{{ __('customer.order.order_date') }}</th>
                                                <th>{{ __('customer.total') }}</th>
                                                <th>{{ __('customer.order.status') }}</th>
                                                <th>{{ __('customer.action') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>{{ $order->user_name }}</td>
                                                    <td>{{ $order->user_email }}</td>
                                                    <td>{{ $order->user_mobile }}</td>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>{{ $order->order_date }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ $order->payment_status }}</td>
                                                    <td>
{{--                                                        <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="{{ route('page.show',[ 'order' => $order->id ]) }}">{{ __('customer.show') }}</a>--}}
                                                        <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="#">{{ __('customer.show') }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>{{ __('customer.order.uname') }}</th>
                                                <th>{{ __('customer.order.uemail') }}</th>
                                                <th>{{ __('customer.order.umobile') }}</th>
                                                <th>{{ __('customer.order.order_num') }}</th>
                                                <th>{{ __('customer.order.order_date') }}</th>
                                                <th>{{ __('customer.total') }}</th>
                                                <th>{{ __('customer.order.status') }}</th>
                                                <th>{{ __('customer.action') }}</th>
                                            </tr>
                                            </tfoot>
                                        </table>

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

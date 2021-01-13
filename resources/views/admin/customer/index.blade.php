@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            @if ($useraddsuccess = Session::get('useraddsuccess'))
                                <div class="card-alert card gradient-45deg-green-teal">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">check</i>{{ $useraddsuccess }}</p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @elseif($usereditsuccess = Session::get('usereditsuccess'))
                                <div class="card-alert card gradient-45deg-green-teal">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">check</i>{{ $usereditsuccess }}</p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @elseif($userdeletesuccess = Session::get('userdeletesuccess'))
                                <div class="card-alert card gradient-45deg-green-teal">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">check</i>{{ $userdeletesuccess }}</p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                        {{ __('customer.customer.customer_section') }}
                                        <a href="{{ route('customer.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right"> {{ __('customer.customer.add') }}</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('customer.customer.sequence_no') }}</th>
                                                    <th>{{ __('customer.customer.name') }}</th>
                                                    <th>{{ __('customer.customer.email') }}</th>
                                                    <th>{{ __('customer.customer.mobile') }}</th>
                                                    <th>{{ __('customer.customer.active_subscription_plan') }}</th>
                                                    <th>{{ __('customer.customer.reset_password') }}</th>
                                                    <th>{{ __('customer.customer.action') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($customers as $customer)

                                                    <tr>
                                                        <td>{{ $customer->id }}</td>
                                                        <td>{{ $customer->name }}</td>
                                                        <td>{{ $customer->email }}</td>
                                                        <td>{{ $customer->phone }}</td>
                                                        <td>plan</td>
                                                        <td><a class="mb-6 btn waves-effect waves-light gradient-45deg-red-pink" onclick="resetCustomerPassword('{{ $customer->email }}')">Reset Link</a></td>
                                                        <td>
                                                            <a class="mb-5 btn waves-effect waves-light gradient-45deg-light-blue-cyan" href="#">{{ __('customer.customer.view_billing') }}</a> <br>
                                                            <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="{{ route('customer.edit',[ 'customer' => $customer->id ]) }}">{{ __('customer.customer.edit') }}</a>
                                                            <a class="mb-5 btn waves-effect waves-light gradient-45deg-amber-amber" onclick="deleteCustomer({{ $customer->user_id }})" href="#">{{ __('customer.customer.delete') }}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>{{ __('customer.customer.sequence_no') }}</th>
                                                    <th>{{ __('customer.customer.name') }}</th>
                                                    <th>{{ __('customer.customer.email') }}</th>
                                                    <th>{{ __('customer.customer.mobile') }}</th>
                                                    <th>{{ __('customer.customer.active_subscription_plan') }}</th>
                                                    <th>{{ __('customer.customer.reset_password') }}</th>
                                                    <th>{{ __('customer.customer.action') }}</th>
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
        function deleteCustomer(id){
            let confirmBox = confirm('{{ __("customer.delete_message") }}');

            if(confirmBox){
                let path = `{{ url('customer/${id}') }}`;
                $('#delete-form').attr('action',path);
                $('#delete-form').submit();
            }
        }

        function resetCustomerPassword(email)
        {
            console.log(email);
            $.ajax({
                type : 'post',
                url : `{{ route('password.email') }}`,
                data : {email :email},
                success : function(response){
                    alert('Password reset email sent');
                },
                error:function(){
                    alert('password reset email was not sent');
                }
            })
        }

        $(document).ready(function(){

            $('#page-length-option').DataTable({
                "responsive": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "order": [[ 0, "desc" ]],
                buttons: [
                    {
                        extend: 'excel',
                        text: '{{ __("customer.excel") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.excel") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.csv") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4 ]
                        },
                    }
                ],
                dom: 'Blfrtip',
            });
        });
    </script>
@endsection

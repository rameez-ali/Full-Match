@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            @if ($roleaddsuccess = Session::get('roleaddsuccess'))
                                <div class="card-alert card gradient-45deg-green-teal">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">check</i>{{ $roleaddsuccess }}</p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @elseif($roleeditsuccess = Session::get('roleeditsuccess'))
                                <div class="card-alert card gradient-45deg-green-teal">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">check</i>{{ $roleeditsuccess }}</p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @elseif($roledeletesuccess = Session::get('roledeletesuccess'))
                                <div class="card-alert card gradient-45deg-green-teal">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">check</i>{{ $roledeletesuccess }}</p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @elseif($permissionsuccess = Session::get('permissionsuccess'))
                                <div class="card-alert card gradient-45deg-green-teal">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">check</i>{{ $permissionsuccess }}</p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                        {{ __('customer.role.section_head') }}
                                        @can('add-role')
                                        <a href="{{ route('role.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right"> {{ __('customer.customer.add') }}</a>
                                        @endcan
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('customer.customer.sequence_no') }}</th>
                                                    <th>{{ __('customer.name') }}</th>
                                                    @can('assigned-permission')
                                                        <th>{{ __('customer.permission') }}</th>
                                                    @endcan
                                                    <th>{{ __('customer.customer.action') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($roles as $role)
                                                    <tr>
                                                        <td>{{ $role->id }}</td>
                                                        <td>{{ $role->title }}</td>
                                                        @can('assigned-permission')
                                                            <td>  <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="{{ route('role.permission',['id' => $role->id ]) }}">{{ __('customer.permission') }}</a></td>
                                                        @endcan
                                                        <td>
                                                            @can('edit-role')
                                                                <a class="mb-5 mr-2 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="{{ route('role.edit',[ 'role' => $role->id ]) }}">{{ __('customer.customer.edit') }}</a>
                                                            @endcan
                                                            @can('delete-role')
                                                               @if(!Bouncer::is(Auth::user())->an('Admin') || $role->title != "Admin")
                                                                <a class="mb-5 btn waves-effect waves-light gradient-45deg-amber-amber" onclick="deleteCustomer({{ $role->id }})" href="#">{{ __('customer.customer.delete') }}</a>
                                                               @endif
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>{{ __('customer.customer.sequence_no') }}</th>
                                                    <th>{{ __('customer.name') }}</th>
                                                    @can('assigned-permission')
                                                        <th>{{ __('customer.permission') }}</th>
                                                    @endcan
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
                let path = `{{ url('role/${id}') }}`;
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

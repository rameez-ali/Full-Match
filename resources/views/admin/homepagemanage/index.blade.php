@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l12">
                        @if ($sectionaddsuccess = Session::get('sectionaddsuccess'))
                            <div class="card-alert card gradient-45deg-green-teal">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">check</i> {{ $sectionaddsuccess }}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif($sectioneditsuccess = Session::get('sectioneditsuccess'))
                            <div class="card-alert card gradient-45deg-green-teal">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">check</i> {{ $sectioneditsuccess }}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif($sectiondeletesuccess = Session::get('sectiondeletesuccess'))
                            <div class="card-alert card gradient-45deg-green-teal">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">check</i> {{ $sectiondeletesuccess }}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif($secalreadyactive = Session::get('secalreadyactive'))
                            <div class="card-alert card gradient-45deg-amber-amber">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">warning</i> {{ $secalreadyactive }}</p>
                                </div>
                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <div class="card animate fadeUp">
                            <div class="card-content">
                                <h4 class="header mt-0">
                                    {{ __('customer.homepgmanage.homepgmanage_section') }}
{{--                                    <a href="{{ route('home-page-manage.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right"> {{ __('customer.add') }}</a>--}}
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <table id="page-length-option" class="display">
                                            <thead>
                                            <tr>
                                                <th>{{ __('customer.id') }}</th>
                                                <th>{{ __('customer.title') }}</th>
                                                <th>{{ __('customer.status') }}</th>
                                                @can('edit-homepg-manage')
                                                <th>{{ __('customer.action') }}</th>
                                                @endcan
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($homepagemanages as $homepagemanage)
                                                <tr>
                                                    <td>{{ $homepagemanage->id }}</td>
                                                    <td>{{ $homepagemanage->name }}</td>
                                                    @if($homepagemanage->status == 1)
                                                        <td>{{ __('customer.active') }}</td>
                                                    @elseif($homepagemanage->status == 0)
                                                        <td>{{ __('customer.de-active') }}</td>
                                                    @endif
                                                    @can('edit-homepg-manage')
                                                    <td>
                                                        <a class="mb-5 btn waves-effect waves-light gradient-45deg-purple-deep-orange" href="{{ route('home-page-manage.edit', $homepagemanage->id ) }}">{{ __('customer.customer.edit') }}</a>
{{--                                                        <a class="mb-5 btn waves-effect waves-light gradient-45deg-amber-amber" onclick="deletePlan({{ $homepagemanage->id }})" href="#">{{ __('customer.delete') }}</a>--}}
                                                    </td>
                                                    @endcan
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>{{ __('customer.id') }}</th>
                                                <th>{{ __('customer.title') }}</th>
                                                <th>{{ __('customer.status') }}</th>
                                                @can('edit-homepg-manage')
                                                    <th>{{ __('customer.action') }}</th>
                                                @endcan
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
                let path = `{{ url('home-page-manage/${id}') }}`;
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
                            columns: [ 0,1,2 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.csv") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2]
                        },
                    }
                ],
                dom: 'Blfrtip',
            });
        });
    </script>
@endsection

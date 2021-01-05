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
                                        Club
                                        <a href="{{ URL::route('club-form.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Add Club</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <h2></h2>
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                 <th width="10%">Club Name</th>
                                                 <th width="10%">Club Logo </th>
                                                 <th width="10%">Club Banner</th>
                                                 <th width="10%">Club Description</th>
                                                 <th width="10%">Club Sorting</th>
                                                 <th width="15%">Action</th>
                                                 </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($club as $club)
                                                <tr>
                                                <td>{{ $club->club_name }}</td>
                                                <td><img src="/images/{{  $club->club_banner}}" style="width:50px;height:50px;" /></td>
                                                <td><img src="/images/{{  $club->club_logo}}" style="width:50px;height:50px;" /></td>
                                                <td>{{ $club->club_description }}</td>
                                                <td>{{ $club->club_sorting }}</td>
                                                <td><form action="{{ route('club-form.destroy', $club->id)}}" method="post">
                                                    <a href="{{ route('club-form.edit',$club->id)}}" class="btn btn-primary">Edit</a>
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                                </form></td>
                                                @endforeach
                                                </tbody>                                              
                                                
                                              
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
    <script src="app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js"></script>
    <script src="app-assets/vendors/data-tables/js/dataTables.select.min.js"></script>
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
                    [10, 25, 50, 75, 100, -1],
                    [10, 25, 50, 75, 100, "All"]
                ],
                "order":[[4,"asc"]],
                buttons: [
                    {
                        extend: 'excel',
                        text: '{{ __("customer.excel") }}',
                        className: 'waves-effect waves-light btn-small',
                        filename : '{{ __("customer.excel") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'waves-effect waves-light btn-small',
                        filename : '{{ __("customer.csv") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5 ]
                        },
                    }
                ],
                dom: 'Blfrtip',
            });
        });
    </script>
@endsection

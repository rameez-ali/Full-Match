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
                                    Video Details
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <h2></h2>
                                        <table id="page-length-option" class="display">
                                            <thead>
                                            <tr>
                                                <th width="20%">Title</th>
                                                <th width="20%">Description</th>
                                                <th width="20%">Link</th>
                                                <th width="20%">Promo</th>
                                                <th width="20%">Category</th>
                                                <th width="20%">League</th>
                                                <th width="20%">Link</th>
                                                <th width="20%">Sorting</th>
                                                <th width="20%">Clubs</th>
                                                <th width="20%">Players</th>
                                                <th width="20%">Genres</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    @foreach($video as $video)
                                                       {{$video->title_en}}
                                                        <td>{{$video->description_en}}</td>
                                                        <td>{{$video->video_link}}</td>
                                                        <td>{{$video->video_promo}}</td>
                                                        <td>{{$video->name_en}}</td>
                                                        @if(isset($video->leaguename))
                                                        <td>{{$video->leaguename}}</td>

                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <td>{{$video->video_link}}</td>
                                                        <td>{{$video->video_sorting}}</td>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach($clubs as $club){{$club->name_en}}, @endforeach
                                                </td>
                                                <td>
                                                    @foreach($players as $item){{$item->name_en}}, @endforeach
                                                </td>
                                                <td>
                                                    @foreach($video_genres as $videogenre){{$videogenre->name_en}}, @endforeach
                                                </td>
                                            </tr>
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
                            columns: [ 0,1,2,3,4,5,6,7,8,9,10 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.csv") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5,6,7,8,9,10 ]
                        },
                    }
                ],
                dom: 'Blfrtip',
            });
        });
    </script>
@endsection

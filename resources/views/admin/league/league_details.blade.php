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
                                    League Details
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <h2></h2>
                                        <table id="page-length-option" class="display">
                                            <thead>
                                            <tr>
                                                <th width="5%">Name</th>
                                                <th width="5%">Description</th>
                                                <th width="10%">Promo Video</th>
                                                <th width="5%">Sorting</th>
                                                <th width="10%">Seasons</th>
                                                <th width="27%">Promo Video URL of Season</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leagues as $league)
                                                <tr>
                                                    <td>
                                                    @if($loop->index == 0)
                                                        {{$league->leaguename}}
                                                         <td>{{ substr_replace(strip_tags($league->description_en,'description'), "...", 20) }}</td>
                                                         @if($league->league_promo_video!=null)
                                                         <td>{{ substr_replace(strip_tags($league->league_promo_video,'promo'), "...", 60) }}</td>
                                                         @else
                                                         <td>{{$league->league_promo_video}}</td>
                                                         @endif
                                                        <td>{{$league->league_sorting}}</td>
                                                    @endif
                                                    @if($loop->index == 0)
                                                        <td>{{$league->name_en}}</td>
                                                        <td>{{ substr_replace(strip_tags($league->video_link,'link'), "...", 60) }}</td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{{$league->name_en}}</td>
                                                        @if($league->video_link!=null)
                                                        <td>{{ substr_replace(strip_tags($league->video_link,'link'), "...", 60) }}</td>
                                                        @else
                                                        <td>{{$league->video_link}}</td>
                                                        @endif
                                                    @endif
                                                </tr>
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
                "order":[[4,"asc"]],
                buttons: [
                    {
                        extend: 'excel',
                        text: '{{ __("customer.excel") }}',
                        className: 'dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.excel") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
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

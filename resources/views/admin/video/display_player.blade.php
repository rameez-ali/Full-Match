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
                                                 <th width="20%">Video Title</th>
                                                  <th width="20%">Video Banner</th>
                                                  <th width="20%">Video Image</th>
                                                  <th width="15%">Video Description</th>
                                                  <th width="15%">Video Link</th>
                                                  <th width="10%">Video Duration</th>
                                                 </tr>
                                                </thead>
                                                 <tbody>
                                                 @foreach($video as $video)
                                                 <tr>
                                               <td>{{ $video->video_title }}</td>
                                               <td><img src="{{ asset('app-assets/images/video/'.$video->video_banner_img)}}"  class="img-thumbnail" width="75" /></td>
                                               <td><img src="{{ asset('app-assets/images/video/'.$video->video_img)}}"  class="img-thumbnail" width="75" /></td>
                                               <td>{{ $video->video_description }}</td>
                                               <td>{{ $video->video_link }}</td>
                                               <td>{{ $video->hour }}:
                                                   {{ $video->minute }}:
                                                   {{ $video->second }}</td>
                                               <td>{{ $video->video_duration }}</td>
                                                </tr>
                                                 @endforeach
                                                 </tbody>                                     
                                                 </tbody>
                                            </table>
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                <th width="27%">Clubs</th>
                                                 </tr>
                                                </thead>
                                                 <tbody>
                                                  @foreach($clubs as $club)
                                                  <tr>
                                                  <td>{{ $club->club_name}}</td>
                                                  </tr>
                                                  @endforeach            
                                                 </tbody>
                                                
                                            </table>

                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                <th width="27%">Players</th>
                                                 </tr>
                                                </thead>
                                                 <tbody>
                                                  @foreach($players as $player)
                                                  <tr>
                                                  <td>{{ $player->player_name}}</td>
                                                  </tr>
                                                  @endforeach            
                                                 </tbody>
                                                
                                            </table>

                                             <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                <th width="27%">Video Genres</th>
                                                 </tr>
                                                </thead>
                                                 <tbody>
                                                  @foreach($video_genres as $video_genre)
                                                  <tr>
                                                  <td>{{ $video_genre->genre_name}}</td>
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

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
                                        Videos
                                        <a href="{{ URL::route('video-form.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Add</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s14">
                                            @if ($videoaddsuccess = Session::get('videoaddsuccess'))
                                                <div class="card-alert card gradient-45deg-green-teal">
                                                    <div class="card-content white-text">
                                                        <p>
                                                            <i class="material-icons"></i>{{ $videoaddsuccess }}</p>
                                                    </div>
                                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if ($videoeditsuccess = Session::get('videoeditsuccess'))
                                                <div class="card-alert card gradient-45deg-green-teal">
                                                    <div class="card-content white-text">
                                                        <p>
                                                            <i class="material-icons"></i>{{ $videoeditsuccess }}</p>
                                                    </div>
                                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if ($videodelsuccess = Session::get('videodelsuccess'))
                                                <div class="card-alert card gradient-45deg-green-teal">
                                                    <div class="card-content white-text">
                                                        <p>
                                                            <i class="material-icons"></i>{{ $videodelsuccess }}</p>
                                                    </div>
                                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                 <th width="5%">Video Title</th>
                                                  <th width="5%">Video Banner</th>
                                                  <th width="5%">Video Image</th>
                                                  <th width="5%">Video Description</th>
                                                  <th width="5%">Video Link</th>
                                                  <th width="5%">Video Sorting</th>
                                                   <th width="80%">Action</th>
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
                                               <td>{{ $video->video_sorting }}</td>
                                              <td><form action="{{ route('video-form.destroy', $video->id)}}" method="post">
                                                    <a href="{{ url('videodetails/'.$video->id)}}" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">Details</a>
                                                    <a href="{{ route('video-form.edit',$video->id)}}" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">Edit</a>
                                                     {{ csrf_field() }}
                                                     @method('DELETE')
                                                     <button onclick="return window.confirm('Are you sure you want to delete this record?');" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow" type="submit">Delete</button>
                                                     </form>
                                                 </td>

                                                </tr>
                                                 @endforeach
                                                 </tbody>
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
                    [10, 25, 50, 75, 100, -1],
                    [10, 25, 50, 75, 100, "All"]
                ],
                buttons: [
                    {
                        extend: 'excel',
                        text: '{{ __("customer.excel") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.excel") }}' ,
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
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

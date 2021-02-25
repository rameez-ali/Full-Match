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
                                    LEAGUES
                                    @can('add-league')
                                    <a href="{{ URL::route('league-form.create') }}" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Add</a>
                                    @endcan
                                </h4>
                                <div class="row">
                                    <div class="col s12">
                                        @if ($leagueaddsuccess = Session::get('leagueaddsuccess'))
                                            <div class="card-alert card gradient-45deg-green-teal">
                                                <div class="card-content white-text">
                                                    <p>
                                                        <i class="material-icons"></i>{{ $leagueaddsuccess }}</p>
                                                </div>
                                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($leagueeditsuccess = Session::get('leagueeditsuccess'))
                                            <div class="card-alert card gradient-45deg-green-teal">
                                                <div class="card-content white-text">
                                                    <p>
                                                        <i class="material-icons"></i>{{ $leagueeditsuccess }}</p>
                                                </div>
                                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($leaguedelsuccess = Session::get('leaguedelsuccess'))
                                            <div class="card-alert card gradient-45deg-green-teal">
                                                <div class="card-content white-text">
                                                    <p>
                                                        <i class="material-icons"></i>{{ $leaguedelsuccess }}</p>
                                                </div>
                                                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif
                                        <table id="page-length-option" class="display">
                                            <thead>
                                            <tr>
                                                <th width="10%">Name</th>
                                                <th width="15%">Description</th>
                                                <th width="10%">Banner</th>
                                                <th width="10%">Promo Video</th>
                                                <th width="10%">Profile Image</th>
                                                <th width="10%">League Sorting</th>
                                                <th width="50%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leagues as $league)
                                                <tr>
                                                    <td>{{ $league->name_en   }}</td>
                                                    <td>{{ substr_replace(strip_tags($league->description_en,'description'), "...", 20) }}</td>
                                                    <td><img src="{{ asset('app-assets/images/league/'.$league->league_banner)}}" style="width:50px;height:50px;" /></td>
                                                    @if($league->league_promo_video!=null)
                                                    <td>{{ substr_replace(strip_tags($league->league_promo_video,'promo'), "...", 60) }}</td>
                                                    @else
                                                    <td>{{$league->league_promo_video}}</td>
                                                    @endif
                                                    <td><img src="{{ asset('app-assets/images/league/'.$league->league_profile_image)}}" style="width:50px;height:50px;" /></td>
                                                    <td>{{ $league->league_sorting }}</td>
                                                    <td><form action="{{ route('league-form.destroy', $league->id)}}" method="post">
                                                            @can('view-leaguedetail')
                                                            <a href="{{ url('leaguedetails/'.$league->id)}}" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">Details</a>
                                                            @endcan
                                                                @can('edit-league')
                                                                <a href="{{ route('league-form.edit',$league->id)}}" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">Edit</a>
                                                            @endcan
                                                                {{ csrf_field() }}
                                                                @can('delete-video')
                                                            @method('DELETE')
                                                            <button onclick="return window.confirm('Are you sure you want to delete this record?');" class="dt-button buttons-excel buttons-html5 waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow" type="submit">Delete</button>
                                                            @endcan
                                                        </form>
                                                    </td>
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
                buttons: [
                    {
                        extend: 'excel',
                        text: '{{ __("customer.excel") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.excel") }}' ,
                        exportOptions: {
                            columns: [ 0,1,3,5 ]
                        },
                    },
                    {
                        extend: 'csv',
                        text: '{{ __("customer.csv") }}',
                        className: 'waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow',
                        filename : '{{ __("customer.csv") }}' ,
                        exportOptions: {
                            columns: [ 0,1,3,5 ]
                        },
                    }
                ],
                dom: 'Blfrtip',
            });
        });
    </script>
@endsection

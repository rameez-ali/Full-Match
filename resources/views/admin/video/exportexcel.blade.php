<style>
    table, tr, th, td {
        border: 1px solid #C0C0C0;
        width:100%;
        text-align: center;
    }
</style>

<?php
header("Content-type: text/xls");
header("Content-Disposition: attachment; filename=file.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<table>
    <thead>
    <tr>
        <th>Video</th>
        <th>Clubs</th>
        <th>Players</th>
        <th>Genres</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td>
            @foreach($video as $video)
                {{$video->title_en}}<br>
            @endforeach
        </td>
        <td>
            @foreach($clubs as $club)
                   {{$club->name_en}}<br>
            @endforeach
        </td>
        <td>
            @foreach($players as $item)
                {{$item->name_en}}<br>
            @endforeach
        </td>
        <td>
            @foreach($video_genres as $videogenre)
                {{$videogenre->name_en}}<br>
            @endforeach
        </td>
    </tr>
    </tbody>

</table>

<?php
die;
?>

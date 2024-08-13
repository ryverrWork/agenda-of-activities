<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/perfect-scrollbar.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
</head>

<body>
    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">
                    <table>
                        <thead>
                            <tr class="table100-head">
                                <th class="column1">Tanggal</th>
                                <th class="column2">Hari</th>
                                <th class="column3">Jam</th>
                                <th class="column4">Kegiatan</th>
                                <th class="column5">Lokasi</th>
                                <th class="column6">PIC</th>
                                <th class="column7">No HP</th>
                                <th class="column8">Undangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td class="column1">{{ $activity->date }}</td>
                                    <td class="column2">{{ $activity->day }}</td>
                                    <td class="column3">{{ $activity->time }}</td>
                                    <td class="column4">{{ $activity->name }}</td>
                                    <td class="column5">{{ $activity->location }}</td>
                                    <td class="column6">{{ $activity->person_in_charge }}
                                    </td>
                                    <td class="column7">{{ $activity->phone_number }}</td>
                                    <td class="column8"><a href="{{ asset('storage/' . $activity->file_url) }}"
                                            download="{{ basename($activity->file_url) }}" title="Download">
                                            <i class="ri-download-line"></i> Download
                                        </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>

<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>

<script>
    $('.js-pscroll').each(function() {
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>

</html>

@extends('layouts.main')
@push('css')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/export.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('statistic') }}" method="GET">
                    <div class="form-inline">
                        <input class="form-control" type="month" id="month" name="month"
                               value="{{ !empty($monthYear) ? $monthYear : old('month') }}">
                        <button class="btn btn-primary mx-2" type="submit">Search</button>
                        <button class="btn btn-primary" type="button" onclick="exportData()">Export</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Họ và tên</th>
                            @foreach($listDate as $item)
                                <th class="whiteSpace">{{ $item }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $employee)
                        <tr>
                            @foreach($employee as $item)
                                <td class="whiteSpace">{{ $item }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    function exportData() {
        let month = $('#month').val();
        let base = '{!! route('exportStatistic') !!}';
        window.location.href = base + '?month=' + month;
    }
</script>


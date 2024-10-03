@extends('user.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Nomor Lot {{ $lot->lot_number }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('lot.index') }}">Lot</a></div>
                <div class="breadcrumb-item">Show</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Download Label Biru</h4>
                </div>

                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table id="example" class="ui selectable celled table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Seri</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($displayData as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row['start_serial_number'] }} - {{ $row['end_serial_number'] }}</td>
                                        <td>
                                            <form class="download-pdf-form" method="POST">
                                                @csrf
                                                <input type="hidden" name="start_serial_number"
                                                    value="{{ $row['start_serial_number'] }}">
                                                <input type="hidden" name="end_serial_number"
                                                    value="{{ $row['end_serial_number'] }}">
                                                <button type="submit" class="btn btn-primary mr-2">Download PDF</button>
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
    </section>
@endsection

@push('scripts')
    <script>
        $('#example').DataTable({
            rowReorder: true,
            layout: {
                topStart: {
                    pageLength: {
                        menu: [10, 25, 50, 100]
                    }
                },
                topEnd: {
                    search: {
                        placeholder: 'Type search here'
                    }
                },
                bottomEnd: {
                    paging: {
                        numbers: 3
                    }
                }
            },
            columnDefs: [{
                    className: "dt-head-center",
                    targets: [0, 1]
                },
                {
                    className: "dt-body-center",
                    targets: [0, 1]
                },
            ]
        });

        $(document).ready(function() {
            $('.download-pdf-form').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var formData = form.serialize();
                var button = form.find('button[type="submit"]');
                button.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: "{{ route('lot.downloadPdf', ['id' => $lot->id]) }}",
                    method: 'POST',
                    data: formData,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response, status, xhr) {
                        var filename = xhr.getResponseHeader('Content-Disposition').split(
                            'filename=')[1].replace(/\"/g, '');
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(response);
                        link.download = filename;
                        link.click();
                        sessionStorage.setItem('success', 'File berhasil diunduh.');
                        location.reload();
                    },
                    error: function(response) {
                        var message = response.responseJSON.warning || response.responseJSON
                            .error;
                        $('#flash-messages').html('<div class="alert alert-danger">' + message +
                            '</div>');
                    },
                    complete: function() {
                        button.prop('disabled', false).text('Download PDF');
                    }
                });
            });
        });
    </script>
@endpush

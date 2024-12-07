<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.: MENU UTAMA :.</title>
    <style>
        /* Resetting margins and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .panel {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .panel-heading {
            background-color: #17a2b8;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .panel-heading h4 {
            margin: 0;
            font-size: 24px;
        }

        .panel-footer {
            padding: 20px;
            background-color: #ffffff;
            border-top: 2px solid #f1f1f1;
        }

        .panel-footer h4,
        .panel-footer h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .panel-footer table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .panel-footer th,
        .panel-footer td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #f1f1f1;
        }

        .panel-footer th {
            background-color: #f7f7f7;
            width: 30%;
        }

        .panel-footer td {
            font-weight: normal;
            color: #333;
        }

        /* Responsive design */
        @media (max-width: 768px) {

            .panel-footer th,
            .panel-footer td {
                font-size: 14px;
                padding: 10px;
            }

            .panel-heading h4 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Main Container -->
    <div class="container">
        <!-- Main Content -->
        <div class="panel panel-info">
            <!-- Header Section -->
            <div class="panel-heading">
                <h4>DINAS PERTANIAN DAN PERKEBUNAN</h4>
            </div>

            <!-- Footer Section with Table -->
            <div class="panel-footer">
                <h4><b>Informasi</b></h4>
                <h2><b>Nomor Sertifikasi sudah terdaftar</b></h2>
                <table id="tabel-verifikasi">
                    <tr>
                        <th>PROVINSI</th>
                        <td>{{ $labels->first()->provinsi ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>JENIS BENIH</th>
                        <td>{{ $labels->first()->seed_class ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>NAMA</th>
                        <td>{{ $labels->first()->seed_producers ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>ALAMAT</th>
                        <td>{{ $labels->first()->address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>REALISASI LUAS</th>
                        <td>{{ $labels->first()->contents_packaging ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>REALISASI PRODUKSI</th>
                        <td>{{ $labels->first()->btl ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>NOMOR LOT</th>
                        <td>{{ $labels->first()->lot_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>KELAS BENIH</th>
                        <td>{{ $labels->first()->seed_class ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>VARIETAS</th>
                        <td>{{ $labels->first()->varieties ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>VOLUME</th>
                        <td>{{ $labels->first()->germination_power ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>ISI KEMASAN</th>
                        <td>{{ $labels->first()->contents_packaging ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>JUMLAH</th>
                        <td>{{ $labels->first()->pure_seeds ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>NO INDUK</th>
                        <td>{{ $labels->first()->registration_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>TGL PANEN</th>
                        <td>{{ $labels->first()->harvest_date ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>TGL SELESAI</th>
                        <td>{{ $labels->first()->test_completion_date ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>HASIL UJI</th>
                        <td>{{ $labels->first()->seed_impurities ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>TGL BERAKHIR</th>
                        <td>{{ $labels->first()->end_distribution_date ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>NO SERI</th>
                        <td>{{ $labels->first()->serial_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>KADAR AIR</th>
                        <td>{{ $labels->first()->water_content ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>KEMURNIAN BENIH</th>
                        <td>{{ $labels->first()->pure_seeds ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>CVL</th>
                        <td>{{ $labels->first()->roomy_CVL ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>GULMA</th>
                        <td>{{ $labels->first()->germination_power ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>KOTORAN</th>
                        <td>{{ $labels->first()->seed_impurities ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>DAYA BERKECAMBAH</th>
                        <td>{{ $labels->first()->germination_power ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>DIPERBARUI</th>
                        <td>{{ $labels->first()->updated_at ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

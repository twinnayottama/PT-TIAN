<?php
$cards_per_row = 4;
$cards_per_page = 20;
$cards_in_current_row = 0;
$cards_in_current_page = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lot PDF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #00b0f0;
        }

        .card {
            width: 378px;
            height: 189px;
            float: left;
            margin: 15px 9.5px;
            border: 0.5px solid;
        }

        .card h4 {
            font-size: 0.9em;
            text-align: center;
            padding-top: 4px;
            letter-spacing: 2px;
        }

        .text-container {
            padding-top: 5px;
            padding-right: 8px;
            padding-left: 8px;
        }

        .container-kanan {
            float: left;
            width: 70%;
        }

        .item {
            font-size: 0.52em;
            padding: 0;
            margin-bottom: 3.5px;
        }

        .container-kiri {
            float: right;
            width: 33%;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="clearfix">
        <div class="container">
        </div>
    </div>
    @foreach ($groupedData as $serial_number => $data)
        @foreach ($data as $item)
            <?php
            // Cek apakah jumlah data pada halaman ini telah mencapai batas
            if ($cards_in_current_page === $cards_per_page) {
                echo '<div class="page-break"></div>'; // Tambahkan page break jika sudah mencapai batas
                $cards_in_current_page = 0; // Set ulang jumlah data pada halaman ini
            }
            
            // Cek apakah jumlah data pada baris ini telah mencapai batas
            if ($cards_in_current_row === $cards_per_row) {
                echo '<div style="clear: both;"></div>'; // Tutup clearfix jika sudah mencapai jumlah data per baris
                $cards_in_current_row = 0; // Set ulang jumlah data pada baris ini
            }
            ?>
            <div class="card clearfix">
                <h4>BENIH UNGGUL BERSERTIFIKAT</h4>
                <div class="text-container">
                    <div class="container-kanan">
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Sertifikat LSSM
                                No.</span> : <span style="vertical-align: top;">{{ $item->certificate_number }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Produsen Benih</span>
                            : <span style="vertical-align: top;">{{ $item->seed_producers }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Alamat</span> : <span
                                style="vertical-align: top;">{{ $item->address }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Kelas Benih</span> :
                            <span style="vertical-align: top;">{{ $item->seed_class }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Jenis Tanaman</span>
                            : <span style="vertical-align: top;">{{ $item->type_plant }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Varietas</span> :
                            <span style="vertical-align: top;">{{ $item->varieties }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">No. Induk
                                Sertifikasi</span> : <span
                                style="vertical-align: top;">{{ $item->registration_number }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">No. Lot</span> :
                            <span style="vertical-align: top;">{{ $lot->lot_number }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Tgl. Panen</span> :
                            <span
                                style="vertical-align: top;">{{ date('d-M-Y', strtotime($item->harvest_date)) }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Tgl. Selesai
                                Uji</span> : <span
                                style="vertical-align: top;">{{ date('d-M-Y', strtotime($item->test_completion_date)) }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Tgl. Akhir Masa
                                Edar</span> : <span
                                style="vertical-align: top;">{{ date('d-M-Y', strtotime($item->end_distribution_date)) }}</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">No. Seri Label</span>
                            : <span style="vertical-align: top;">{{ $item->serial_number }}</span>
                        </div>
                    </div>
                    <div class="container-kiri">
                        <div style="text-align: center;">
                            <img src="{{ $item->barcode_data_uri }}" alt="Barcode" class="img-barcode"
                                style="width: 60px; margin-bottom: 7px" />
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Isi Kemasan</span> :
                            <span style="vertical-align: top;">{{ $item->contents_packaging }} Kg</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Kadar Air</span> :
                            <span style="vertical-align: top;">{{ number_format($item->water_content, 1, ',', '.') }}
                                %</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Benih Murni</span> :
                            <span style="vertical-align: top;">{{ number_format($item->pure_seeds, 1, ',', '.') }}
                                %</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">CVL Lapang</span> :
                            <span style="vertical-align: top;">{{ number_format($item->roomy_CVL, 1, ',', '.') }}
                                %</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">BTL/Biji Gulma</span>
                            : <span style="vertical-align: top;">{{ number_format($item->btl, 1, ',', '.') }} %</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Kotoran Benih</span>
                            : <span
                                style="vertical-align: top;">{{ number_format($item->seed_impurities, 1, ',', '.') }}
                                %</span>
                        </div>
                        <div class="item">
                            <span style="display: inline-block; width: 80px; vertical-align: top;">Daya
                                Berkecambah</span> : <span style="vertical-align: top;">{{ $item->germination_power }}
                                %</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // Update jumlah data pada setiap baris dan halaman
            $cards_in_current_row++;
            $cards_in_current_page++;
            ?>
        @endforeach
    @endforeach
</body>

</html>

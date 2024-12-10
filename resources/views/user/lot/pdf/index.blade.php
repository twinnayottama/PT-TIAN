<?php
$cards_per_row = 4;
$cards_per_page = 20;
$cards_in_current_row = 0;
$cards_in_current_page = 0;
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lot PDF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #FFE31A;
        }

        .card {
            width: 378px;
            height: 189px;
            float: left;
            margin: 15px 9.5px;
            border: 0.5px solid;
        }

        /* Container for logo and headings */
        .header-container {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            /* Center the content horizontally */
            margin: 0;
            padding: 0;
            position: relative;
        }

        /* Logo styling */
        .logo {
            width: 35px;
            height: auto;
            margin-right: 5px;
            margin-top: 0;
            position: absolute;
            left: 10px;
            top: 0;
        }

        .header-container div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            /* Center the text */
            padding-left: 30px;
        }

        /* Adjusted sizes for h4 and h6 */
        .card h4,
        .card h6 {
            text-align: center;
            /* Center the text */
            margin: 0;
        }

        .card h4 {
            font-size: 0.8em;
            letter-spacing: 1px;
        }

        .card h6 {
            font-size: 0.7em;
            color: #000000;
        }

        /* Styling for horizontal line */
        .card h4+hr {
            border: 0;
            border-top: 1px solid #000;
            margin: 10px 0;
        }

        .text-container {
            background: transparent;
            padding-top: 5px;
            padding-right: 8px;
            padding-left: 8px;
        }

        .container-kanan {
            float: left;
            width: 65%;
        }

        .container-kiri {
            float: right;
            width: 45%;
            margin-top: 20px;
        }

        .item {
            font-size: 0.52em;
            padding: 0;
            margin-bottom: 3.5px;
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

    <?php foreach ($groupedData as $serial_number => $data): ?>
    <?php foreach ($data as $item): ?>
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
        <div class="header-container">
            <img src="assets/img/TIAN.png" alt="Logo" class="logo">
            <div>
                <h4>PT. TAMAN INOVASI AGRO NUSANTARA</h4>
                <h6>Jl. Puskesmas KM 01 Kec. Ngasem, Kab. Kediri</h6>
            </div>
        </div>

        <hr>

        <div class="text-container">
            <div class="container-kanan">
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">No. Lot</span> :
                    <span style="vertical-align: top;">{{ $item->certificate_number }}
                        {{-- {{ $lot->lot_number }} --}}
                    </span>
                </div>

                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Benih</span> :
                    <span style="vertical-align: top;">Materi Induk Jagung Klas {{ $item->seed_class }}</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Galur</span> :
                    <span style="vertical-align: top;">{{ $item->varieties }}</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Berat Bersih</span> :
                    <span style="vertical-align: top;">{{ $item->contents_packaging }} Kg</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Tgl. Selesai
                        Uji</span> : <span
                        style="vertical-align: top;">{{ date('d-M-Y', strtotime($item->test_completion_date)) }}</span>
                </div>

                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Asal Benih</span> :
                    <span style="vertical-align: top;">{{ $item->address }}</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Kadar Air</span> :
                    <span style="vertical-align: top;">{{ number_format($item->water_content, 1, ',', '.') }}
                        %</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Daya
                        Tumbuh</span> : <span style="vertical-align: top;">{{ $item->germination_power }}
                        %</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Kemurnian
                        Benih</span> :
                    <span style="vertical-align: top;">{{ number_format($item->pure_seeds, 1, ',', '.') }}
                        %</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Kotoran Benih</span>
                    : <span style="vertical-align: top;">{{ number_format($item->seed_impurities, 1, ',', '.') }}
                        %</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Pemohon</span>
                    : <span style="vertical-align: top;">{{ $item->seed_producers }}</span>
                </div>


            </div>
            <div class="container-kiri">
                <div style="text-align: center;">
                    <img src="{{ $item->barcode_data_uri }}" alt="Barcode" class="img-barcode"
                        style="width: 60px; margin-bottom: 7px" />
                    {{-- <img src="assets/img/Barcode.png" alt="Barcode" class="Barcode"
                        style="width: 60px; margin-bottom: 7px"> --}}
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">Tgl. Akhir
                        Label</span> : <span
                        style="vertical-align: top;">{{ date('d-M-Y', strtotime($item->end_distribution_date)) }}</span>
                </div>
                <div class="item">
                    <span style="display: inline-block; width: 80px; vertical-align: top;">No. Seri Label</span>
                    : <span
                        style="vertical-align: top;">{{ $item->no_area }}/{{ date('m/y', strtotime($item->test_completion_date)) }}/{{ $item->code_area }}{{ $item->serial_number }}</span>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Update jumlah data pada setiap baris dan halaman
    $cards_in_current_row++;
    $cards_in_current_page++;
    ?>
    <?php endforeach; ?>
    <?php endforeach; ?>
</body>

</html>

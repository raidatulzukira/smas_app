<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uji Keamanan XSS</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        .box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .safe {
            background-color: #e6ffed;
            border-color: #28a745;
        }

        .danger {
            background-color: #ffeef0;
            border-color: #dc3545;
        }
    </style>
</head>

<body>
    <h1>Hasil Uji XSS (Security Check)</h1>

    <div class="box safe">
        <h3>1. Menggunakan Kurung Kurawal Ganda <code>&lcub;&lcub; &rcub;&rcub;</code> (Aman)</h3>
        <p>Output yang dihasilkan:</p>
        {{ $data }}
    </div>

    <div class="box danger">
        <h3>2. Menggunakan Kurung Kurawal Tanda Seru <code>&lcub;!! !!&rcub;</code> (Bahaya - Dihapus untuk Keamanan)</h3>
        <p>Bagian ini telah dihapus untuk mencegah XSS. Gunakan <code>&lcub;&lcub; &rcub;&rcub;</code> saja.</p>
        <!-- {!! $data !!} -->
    </div>
</body>

</html>

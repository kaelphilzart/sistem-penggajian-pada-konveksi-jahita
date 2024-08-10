<!DOCTYPE html>
<html>
<head>
    <title>Detail Pcs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 50%;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #000;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h4, .header p {
            margin: 0;
        }
        .content {
            display: flex;
            justify-content: space-between;
        }
        .content div {
            flex: 1;
        }
        .content p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center"> <h4>Dwi Tailor</h4></div>
        <div class="header">
            <h4>{{ strtoupper($dataDetail->nama_pcs) }}</h4>
        </div>
        <div class="header">
            <h4>{{ $dataDetail->nama_kry }}</h4>
            <h4>Keterangan Ukuran</h4>
        </div>
        <div class="content">
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>jenis</th>
                            <th>Ukuran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Panjang lengan</td>
                            <td>{{ $dataDetail->panjang_lengan }} cm</td>
                        </tr>
                        <tr>
                            <td>Lingkar dada</td>
                            <td>{{ $dataDetail->lingkar_dada }} cm</td>
                        </tr>
                        <tr>
                            <td>Lingkar pinggang</td>
                            <td>{{ $dataDetail->lingkar_pinggang }} cm</td>
                        </tr>
                        <tr>
                            <td>Panjang baju</td>
                            <td>{{ $dataDetail->panjang_baju }} cm</td>
                        </tr>
                        <tr>
                            <td>Lingkar lengan</td>
                            <td>{{ $dataDetail->lingkar_lengan }} cm</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

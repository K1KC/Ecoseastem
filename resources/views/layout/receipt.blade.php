<!DOCTYPE html>
<html>
<head>
    <title>Your Receipt</title>
</head>
<body style="background-color: #f3f4f6; font-family: Arial, sans-serif; margin: 0; padding: 0; width: 100%;">

<div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div style="background-color: #4f46e5; padding: 20px; text-align: center;">
        <h1 style="color: #ffffff; font-size: 24px; font-weight: bold; margin: 0;">Your Receipt</h1>
        <p style="color: #d1d5db; font-size: 12px; margin: 0;">Bukti Pembayaran Anda</p>
    </div>
    <div style="padding: 20px;">
        <p style="font-size: 16px; color: #374151; margin-bottom: 10px;">Thank you for your purchase!</p>
        <p style="font-size: 12px; color: #6b7280; margin-bottom: 20px;">Terima kasih atas pembelian Anda!</p>

        <p style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">Here are the details of your transaction:</p>
        <p style="font-size: 12px; color: #9ca3af; margin-bottom: 20px;">Berikut adalah rincian transaksi Anda:</p>

        <ul style="list-style: none; padding: 0; margin: 0;">
            <li style="border-bottom: 1px solid #e5e7eb; padding: 10px 0; font-size: 14px;">
                <span style="font-weight: bold; color: #111827;">Order ID:</span> ORDER-{{ $receiptData['order_id'] }}
                <p style="font-size: 12px; color: #6b7280; margin: 0;">ID Pesanan</p>
            </li>
            
            <li style="border-bottom: 1px solid #e5e7eb; padding: 10px 0; font-size: 14px;">
                <span style="font-weight: bold; color: #111827;">Name:</span> {{ $receiptData['name'] }}
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Nama</p>
            </li>

            <li style="border-bottom: 1px solid #e5e7eb; padding: 10px 0; font-size: 14px;">
                <span style="font-weight: bold; color: #111827;">Phone:</span> {{ $receiptData['phone'] }}
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Telepon</p>
            </li>

            <li style="border-bottom: 1px solid #e5e7eb; padding: 10px 0; font-size: 14px;">
                <span style="font-weight: bold; color: #111827;">Item:</span> {{ $receiptData['merch_name'] }}
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Barang</p>
            </li>

            <li style="border-bottom: 1px solid #e5e7eb; padding: 10px 0; font-size: 14px;">
                <span style="font-weight: bold; color: #111827;">Total:</span> ${{ $receiptData['total'] }}
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Jumlah</p>
            </li>
            <li style="padding: 10px 0; font-size: 14px;">
                <span style="font-weight: bold; color: #111827;">Date:</span> {{ $receiptData['date'] }}
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Tanggal</p>
            </li>
        </ul>

        <p style="font-size: 14px; color: #6b7280; margin-top: 20px;">
            If you have any questions, feel free to contact us.
        </p>
        <p style="font-size: 12px; color: #9ca3af; margin-top: 5px;">
            Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.
        </p>
    </div>
    <div style="background-color: #f9fafb; padding: 10px; text-align: center;">
        <p style="font-size: 12px; color: #6b7280; margin: 0;">Thank you for choosing our service!</p>
        <p style="font-size: 10px; color: #9ca3af; margin: 0;">Terima kasih telah memilih layanan kami!</p>
    </div>
</div>

</body>
</html>

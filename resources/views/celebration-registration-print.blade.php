<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - {{ $registration->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #333;
            background: #fff;
            padding: 0;
            position: relative;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            opacity: 0.15;
            pointer-events: none;
        }

        .watermark-logo {
            width: 400px;
            height: 400px;
            filter: grayscale(100%);
        }

        .print-container {
            width: 8.5in;
            height: 11in;
            margin: 0 auto;
            padding: 0.4in;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 0.2in;
            border-bottom: 1px solid #2c3e50;
            padding-bottom: 0.1in;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 0.1in;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto;
        }

        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 3px;
            color: #2c3e50;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 5px;
            color: #34495e;
        }

        .header p {
            font-size: 11pt;
            color: #7f8c8d;
        }

        .section {
            margin-bottom: 0.15in;
        }

        .section-title {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 6px;
            color: #2c3e50;
            border-bottom: 1px solid #e1e8ed;
            padding-bottom: 2px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .info-table td {
            padding: 5px 6px;
            border: 0.5px solid #e1e8ed;
            vertical-align: top;
        }

        .label {
            font-size: 11pt;
            font-weight: bold;
            width: 25%;
            background-color: #f8f9fa;
            color: #34495e;
        }

        .value {
            width: 25%;
            font-size: 11pt;
        }

        .images-section {
            margin: 0.15in 0;
        }

        .images-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.15in;
            margin-top: 8px;
        }

        .image-container {
            text-align: center;
        }

        .image-label {
            font-weight: bold;
            margin-bottom: 4px;
            font-size: 11pt;
            color: #34495e;
        }

        .image-placeholder {
            height: 90px;
            border: 0.5px dashed #bdc3c7;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            font-size: 8pt;
            color: #7f8c8d;
        }

        .signature-section {
            margin-top: 0.2in;
            position: absolute;
            bottom: 0.4in;
            width: calc(100% - 0.8in);
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .signature-table td {
            padding: 25px 10px 5px 10px;
            text-align: center;
            border-bottom: 0.5px solid #000;
            font-size: 9pt;
        }

        .footer {
            position: absolute;
            bottom: 0.1in;
            width: calc(100% - 0.8in);
            text-align: center;
            font-size: 10pt;
            color: #7f8c8d;
            border-top: 0.5px solid #bdc3c7;
            padding-top: 5px;
        }

        @media print {
            body {
                padding: 0;
                font-size: 11pt;
            }

            .no-print {
                display: none !important;
            }

            .print-container {
                padding: 0.4in;
                width: 8.5in;
                height: 11in;
            }

            .watermark {
                opacity: 0.1;
            }

            .info-table td {
                border: 0.3px solid #e1e8ed;
            }

            .signature-table td {
                border-bottom: 0.3px solid #000;
            }
        }

        .no-print {
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1000;
        }

        .print-button {
            background-color: #3498db;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 9pt;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .print-button:hover {
            background-color: #2980b9;
        }

        .back-button {
            background-color: #95a5a6;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 9pt;
            text-decoration: none;
            display: inline-block;
            margin-left: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .back-button:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="watermark">
        <img src="/public/logo.png" alt="Watermark Logo" class="watermark-logo">
    </div>

    <div class="no-print">
        <button onclick="window.print()" class="print-button">
            Print Form
        </button>
        <button onclick="window.location.href='{{ route('celebration.registration.show', $registration->id) }}'" class="back-button">
            Back
        </button>
    </div>

    <div class="print-container">
        <!-- Letterhead -->
        <div class="header">
            <div class="logo-container">
                <img src="/public/logo.png" alt="Faujdarhat Cadet College Logo" class="logo">
            </div>
            <h1>OCECF 20th Anniversary Celebration</h1>
            <h2>Registration Form</h2>
            <p>Registration ID: #{{ $registration->id }} | Date: {{ $registration->created_at->format('d M Y') }}</p>
        </div>

        <!-- Personal Information Section -->
        <div class="section">
            <div class="section-title">Personal Information</div>
            <table class="info-table">
                <tr>
                    <td class="label">Full Name:</td>
                    <td class="value">{{ $registration->name }}</td>
                    <td class="label">Mobile Number:</td>
                    <td class="value">{{ $registration->mobile_num }}</td>
                </tr>
                <tr>
                    <td class="label">Email Address:</td>
                    <td class="value">{{ $registration->email }}</td>
                    <td class="label">Emergency Contact:</td>
                    <td class="value">{{ $registration->emergency_contact }}</td>
                </tr>
                <tr>
                    <td class="label">Full Address:</td>
                    <td class="value" colspan="3">{{ $registration->address }}</td>
                </tr>
                <tr>
                    <td class="label">National ID (NID):</td>
                    <td class="value">{{ $registration->nid }}</td>
                    <td class="label">BNCC Batch:</td>
                    <td class="value">{{ $registration->bncc_batch }}</td>
                </tr>
            </table>
        </div>

        <!-- Registration Details Section -->
        <div class="section">
            <div class="section-title">Registration Details</div>
            <table class="info-table">
                <tr>
                    <td class="label">Family Members:</td>
                    <td class="value">{{ $registration->family_members }}</td>
                    <td class="label">Children (Below 5):</td>
                    <td class="value">{{ $registration->children_count }}</td>
                </tr>
                <tr>
                    <td class="label">Driver:</td>
                    <td class="value">{{ $registration->has_driver ? 'Yes' : 'No' }}</td>
                    <td class="label">Religion:</td>
                    <td class="value">{{ $registration->religion }}</td>
                </tr>
                <tr>
                    <td class="label">Children Under Five:</td>
                    <td class="value">{{ $registration->has_children_under_five ? 'Yes' : 'No' }}</td>
                    <td class="label">Attend Thursday Night:</td>
                    <td class="value">{{ $registration->attend_wednesday_night ? 'Yes' : 'No' }}</td>
                </tr>
            </table>
        </div>

        <!-- Payment Information Section -->
        <div class="section">
            <div class="section-title">Payment Information</div>
            <table class="info-table">
                <tr>
                    <td class="label">Payment Method:</td>
                    <td class="value">{{ $registration->payment_method }}</td>
                    <td class="label">Transaction Number:</td>
                    <td class="value">{{ $registration->transaction_number }}</td>
                </tr>
                <tr>
                    <td class="label">Registration Fee:</td>
                    <td class="value">BDT {{ number_format($registration->amount - $registration->cashout_fee, 2) }}</td>
                    @if($registration->cashout_fee > 0)
                    <td class="label">Cashout Fee:</td>
                    <td class="value">BDT {{ number_format($registration->cashout_fee, 2) }}</td>
                    @else
                    <td class="label">Cashout Fee:</td>
                    <td class="value">BDT 0.00</td>
                    @endif
                </tr>
                <tr>
                    <td class="label">Total Amount Paid:</td>
                    <td class="value" colspan="3">BDT {{ number_format($registration->amount, 2) }}</td>
                </tr>
            </table>
        </div>

        <!-- Images Section -->
        <div class="section images-section">
            <div class="section-title">Attached Documents</div>
            <div class="images-grid">
                <div class="image-container">
                    <div class="image-label">Passport Size Photo</div>
                    @if($registration->passport_photo)
                        <img src="/{{ $registration->passport_photo }}" alt="Passport Photo" style="max-width: 100%; max-height: 90px; border: 0.5px solid #bdc3c7;">
                    @else
                        <div class="image-placeholder">No Photo Attached</div>
                    @endif
                </div>

                <div class="image-container">
                    <div class="image-label">Payment Slip</div>
                    @if($registration->transaction_screenshot)
                        <img src="/{{ $registration->transaction_screenshot }}" alt="Payment Slip" style="max-width: 100%; max-height: 90px; border: 0.5px solid #bdc3c7;">
                    @else
                        <div class="image-placeholder">No Payment Slip Attached</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="section signature-section">
            <div class="section-title">Official Use</div>
            <table class="signature-table">
                <tr>
                    <td>Prepared By</td>
                    <td>Verified By</td>
                    <td>Authorized Signature</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>This is an official document of OCECF 20th Anniversary Celebration</p>
            <p>For inquiries, contact: support@ocecf.org</p>
        </div>
    </div>
</body>
</html>
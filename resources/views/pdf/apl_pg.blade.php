
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PGT Appointment Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            line-height: 1.6;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        .underline {
            text-decoration: underline;
        }

        .center {
            text-align: center;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .footer {
            margin-top: 50px;
        }

        ol {
            padding-left: 20px;
        }
    </style>
</head>

<body>

    <h3><strong>GOVT. OF ASSAM</strong></h3>
    <h3><strong>OFFICE OF THE DIRECTOR OF EDUCATION, B.T.C., KOKRAJHAR</strong></h3>
    <p class="center underline"><strong>O R D E R</strong><br>Dated Kokrajhar the <strong>18<sup>th</sup> June, 2025</strong></p>

    <p><strong>No. DE/BTC/Aptt-3/PGT/2025/<span class="underline">{{$candDetails->letterCode ?? ''}}</span></strong> In exercise of power conferred upon the Director of Education,
        BTC, Kokrajhar by the Secretary, BTC, Kokrajhar vide letter No. BTC/Edn(El)-35/2005/1, dated, 13-09-2005 and in
        pursuance of approval of BTC vide letter No. BTC/Edn-04/2021-22/505, dated 17-06-2025, subject to discharge at
        any time without notice and without assigning any reason thereof Sri <span class="underline">{{$candDetails->name ?? ''}}</span>, S/o,/D/o,/W/o, Sri
        <span class="underline">{{$candDetails->fatherName ?? ''}}</span>, Address <span class="underline">{{$candDetails->address}}</span>, Dist. <span class="underline">{{$candDetails->district ?? ''}}</span> is hereby appointed as Post Graduate Teacher in
        <span class="underline">{{($candDetails->vacency_details->school_vacency->vacencyCategory ?? '') ? ($candDetails->vacency_details->school_vacency->vacencyCategory ?? '') . ',' : ($candDetails->vacency_details->school_vacency->vacencyCategory ?? '') }}</span> <span class="underline"> {{ $candDetails->vacency_details->school_vacency->medium }} </span> in the scale of pay (PB-3) Rs. 22,000/- to Rs. 97,000/- and Grade pay Rs. 11,800/- p.m. plus other
        allowances as admissible under the Govt. rule and posted at <span class="underline">{{$candDetails->vacency_details->school_vacency->schoolName ?? ''}}</span>, vice <span class="underline">{{$candDetails->vacency_details->replcedPersion ?? ''}}</span>,
        Retired/Expired/VRS/Transferred.</p>

    <p>This post has been approved by the BTC authority vide letter No. BTC/Edn-04/2021-22/414, dated 12<sup>th</sup>
        February, 2024.</p>

    <p>As per letter of the Finance (B) Department No. BW/3/2003/Pt-II/1, dated 25-01-2005, the candidate appointed as
        stated above shall furnish an undertaking along with joining report to the Head of the Institution concerned
        which reads as follows:</p>

    <p style="margin-left: 30px; font-style: italic;">“I understand and accept that the Govt. Servant joining the service
        in the State Govt. on or after 01-02-2005 shall not be governed by the existing Assam Service (pension) rules,
        1969 and order issued there under from time to time and that the pension and other retirement benefit will be by
        a set-up new pension rules which are being formulated in the line with the contributory pension scheme of the
        Govt. of India going to be notified in due course”.</p>

    <div class="signature">
        <p><strong>Sd/- J.P. Brahma, AES</strong><br>
            Director of Education<br>
            Bodoland Territorial Council,<br>
            Kokrajhar</p>
    </div>

    <div class="footer">
        <p><strong>Memo No. DE/BTC/Aptt-3/PGT/2025/<span class="underline">{{$candDetails->letterCode ?? ''}}</span> -A,</strong> Dated Kokrajhar the <strong>18<sup>th</sup> June,
                2025</strong><br>
            <u>Copy forwarded for information and necessary action to:</u>
        </p>

        <ol>
            <li>The Secretary, Department of School Education to the Govt. of Assam, Dispur, Ghy-6.</li>
            <li>The Secretary, Education Department, BTC, Kokrajhar.</li>
            <li>The Secretary, Finance Department, BTC, Kokrajhar.</li>
            <li>The S.S.O to the Hon’ble Chief, BTC, Kokrajhar</li>
            <li>The PA/PS to the Principal Secretary, BTC, Kokrajhar</li>
            <li>The Treasury Officers, of concerned treasuries</li>
            <li>The Inspector of Schools, Kokrajhar/Chirang/Baksa/Udalguri</li>
            <li>The Principal, <span class="underline">{{$candDetails->vacency_details->school_vacency->schoolName ?? ''}}  for information.</li>
            <li>The Person concerned. He/She is directed to join the school within 15 (fifteen) days from the date of
                issue of this order failing which the appointment shall be treated as cancelled.</li>
            <li>The Office guard file.</li>
        </ol>

        <p class="signature">
            Director of Education<br>
            Bodoland Territorial Council<br>
            Kokrajhar
        </p>
    </div>

</body>

</html>

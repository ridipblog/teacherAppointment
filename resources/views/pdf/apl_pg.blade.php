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

    <body>

        <h3><strong>GOVT. OF ASSAM</strong></h3>
        <h3><strong>OFFICE OF THE DIRECTOR OF EDUCATION, B.T.C., KOKRAJHAR</strong></h3>

        <p class="center underline"><strong>O R D E R</strong><br>
            Dated Kokrajhar the <strong>{{ $candDetails->letterDateFormatted ?? 'X<sup>th</sup> July, 2025' }}</strong>
        </p>

        <p>
            <strong>No. DE/BTC/Aptt****/**** </strong>.
            In exercise of power conferred upon the Director of Education, BTC, Kokrajhar by the Secretary, BTC,
            Kokrajhar vide letter No. BTC/Edn(El)-35/2005/1, dated, 13th Sept/2005 and in pursuance of approval of BTC
            vide letter No. <span class="underline">{{ $candDetails->letterCode ?? '' }}</span>, dtd
            <span class="underline">{{ $candDetails->approvalDate ?? '..........' }}</span> and subject to discharge at
            any time without notice and without assigning any reason thereof, Sri/Ms <span
                class="underline">{{ $candDetails->name ?? '' }}</span>, S/o,/D/o,/W/o, Sri <span
                class="underline">{{ $candDetails->fatherName ?? '' }}</span>, Address: <span
                class="underline">{{ $candDetails->address ?? '' }}</span>, Dist: <span
                class="underline">{{ $candDetails->district ?? '' }}</span> is hereby appointed as Assistant Teacher
            (<span class="underline">{{ $candDetails->vacency_details->school_vacency->vacencyCategory ?? '' }}</span>,
            <span class="underline">{{ $candDetails->vacency_details->school_vacency->medium ?? '' }}</span>) in the
            scale of pay (PB-2) Rs. 14,000/- to Rs. 70,000/- and Grade pay Rs. <span
                class="underline">{{ $candDetails->gradePay ?? '8700' }}</span>/- p.m. plus other allowances as
            admissible under the Govt. rule and posted at <span
                class="underline">{{ $candDetails->vacency_details->school_vacency->schoolName ?? '' }}</span> vice
            <span class="underline">{{ $candDetails->vacency_details->replcedPersion ?? '' }}</span>,
            Retired/Expired/VRS/Transferred/Resigned.
        </p>

        <p>
            The said filled up post has the approval of Finance (SIU) Deptt’s vide their No. <span
                class="underline">{{ $candDetails->financeApprovalNo ?? '...................................................' }}</span>.
        </p>

        <p>
            As per letter of the Finance (B) Department No. BW/3/2003/Pt-II/1, dtd. 25-1-2005 the candidate appointed as
            stated above shall furnish an undertaking along with joining report to the Head of the Institution concerned
            which read as follows:–
        </p>

        <p style="margin-left: 30px; font-style: italic;">
            “I understand and accept that the Govt. Servant joining the service in the State Govt. on or after
            01-02-2005 shall not be governed by the existing Assam Service (pension) rules, 1969 and order issued there
            under from time to time and that the pension and other retirement benefit will be by a set-up new pension
            rules which are being formulated in the line with the contributory pension scheme of the Govt. of India
            going to be notified in due course”.
        </p>

        <div class="signature">
            <p><strong>Sd/- J.P. Brahma, AES</strong><br>
                Director of Education<br>
                Bodoland Territorial Council,<br>
                Kokrajhar</p>
        </div>

        <div class="footer">
            <p><strong>Memo No.DE/BTC/Aptt****/****<span class="underline">{{ $candDetails->letterCode ?? '' }}</span>
                    -A,</strong> Dated Kokrajhar the
                <strong>{{ $candDetails->memoDateFormatted ?? 'X<sup>th</sup> August, 2025' }}</strong>
            </p>

            <u>Copy forwarded for information and necessary action to:-</u>
            <ol>
                <li>The Secretary, Department of School Education, Assam, Dispur, Ghy-6.</li>
                <li>The Secretary, Education Department, BTC, Kokrajhar.</li>
                <li>The Sr. SO to the Hon'ble Chief, BTC, Kokrajhar.</li>
                <li>The Sr. SO to the Principal Secretary, BTC, Kokrajhar.</li>
                <li>The F.A., Finance Department, BTC Kokrajhar.</li>
                <li>The Treasury Officer, Kokrajhar / Gossaigaon / Bijni / Udalguri / Mushalpur/ Tamulpur/
                    Bhergaon/Kajalgaon.</li>
                <li>The District Ele. Edn. Officer, {{ $candDetails->schoolDistrict ?? '..............' }}</li>
                <li>The {{ $candDetails->ddoName ?? 'DDO Name' }}</li>
                <li>The Headmaster, {{ $candDetails->vacency_details->school_vacency->schoolName ?? '' }}</li>
                <li>The person concerned. He/She is directed to join the school within 15 (fifteen) days from the date
                    of issue of this order failing which the appointment shall be treated as cancelled.</li>
                <li>Office guard file.</li>
            </ol>

            <p class="signature">
                Director of Education<br>
                Bodoland Territorial Council<br>
                Kokrajhar
            </p>
        </div>

    </body>


</body>

</html>

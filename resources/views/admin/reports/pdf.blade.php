<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        Community Blood Donor Report
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px;
            font-family: Arial, Helvetica, sans-serif;
            color: #1f2937;
            background: white;
        }

        .report {
            max-width: 1000px;
            margin: auto;
        }

        .header {
            border-bottom: 3px solid #e32632;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            color: #a80e1c;
            font-size: 28px;
        }

        .header p {
            margin: 7px 0 0;
            color: #667085;
            font-size: 14px;
        }

        .period {
            margin-top: 12px;
            font-size: 13px;
            color: #344054;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .summary-box {
            border: 1px solid #e4e7ec;
            border-radius: 10px;
            padding: 18px;
        }

        .summary-label {
            color: #667085;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 25px;
            font-weight: bold;
            color: #101828;
        }

        .section {
            margin-top: 30px;
        }

        .section h2 {
            color: #101828;
            font-size: 19px;
            margin: 0 0 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f9fafb;
            color: #475467;
            text-align: left;
            font-size: 12px;
            padding: 12px;
            border: 1px solid #e4e7ec;
        }

        td {
            padding: 12px;
            border: 1px solid #e4e7ec;
            font-size: 13px;
        }

        .footer {
            border-top: 1px solid #e4e7ec;
            margin-top: 40px;
            padding-top: 15px;
            color: #98a2b3;
            font-size: 11px;
            text-align: center;
        }

        .print-button {
            position: fixed;
            right: 25px;
            top: 20px;
            background: #e32632;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 18px;
            cursor: pointer;
            font-weight: bold;
        }

        @media print {

            body {
                padding: 0;
            }

            .print-button {
                display: none;
            }

            .report {
                max-width: none;
            }

        }

        @media (max-width: 700px) {

            body {
                padding: 20px;
            }

            .summary {
                grid-template-columns: 1fr 1fr;
            }

        }

    </style>

</head>


<body>

<button
    class="print-button"
    onclick="window.print()"
>
    Print / Save as PDF
</button>


<div class="report">

    <div class="header">

        <h1>
            COMMUNITY BLOOD DONOR
        </h1>

        <p>
            Reports & Statistics
        </p>

        <div class="period">

            <strong>
                Report Period:
            </strong>

            {{ $from->format('F d, Y') }}

            -

            {{ $to->format('F d, Y') }}

        </div>

    </div>


    <div class="summary">

        <div class="summary-box">

            <div class="summary-label">
                Total Donations
            </div>

            <div class="summary-value">
                {{ number_format($totalDonations) }}
            </div>

        </div>


        <div class="summary-box">

            <div class="summary-label">
                Registered Donors
            </div>

            <div class="summary-value">
                {{ number_format($totalDonors) }}
            </div>

        </div>


        <div class="summary-box">

            <div class="summary-label">
                Blood Requests
            </div>

            <div class="summary-value">
                {{ number_format($totalRequests) }}
            </div>

        </div>


        <div class="summary-box">

            <div class="summary-label">
                Completed Requests
            </div>

            <div class="summary-value">
                {{ number_format($completedRequests) }}
            </div>

        </div>

    </div>


    <div class="section">

        <h2>
            Donations by Blood Type
        </h2>

        <table>

            <thead>

                <tr>
                    <th>Blood Type</th>
                    <th>Donations</th>
                </tr>

            </thead>

            <tbody>

                @foreach($bloodTypeStats as $bloodType => $count)

                    <tr>

                        <td>
                            {{ $bloodType }}
                        </td>

                        <td>
                            {{ number_format($count) }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>


    <div class="section">

        <h2>
            Monthly Summary
        </h2>

        <table>

            <thead>

                <tr>

                    <th>
                        Month
                    </th>

                    <th>
                        Donations
                    </th>

                    <th>
                        New Donors
                    </th>

                    <th>
                        Blood Requests
                    </th>

                </tr>

            </thead>


            <tbody>

                @foreach($monthlyStats as $month)

                    <tr>

                        <td>
                            {{ $month['month'] }}
                        </td>

                        <td>
                            {{ number_format($month['donations']) }}
                        </td>

                        <td>
                            {{ number_format($month['new_donors']) }}
                        </td>

                        <td>
                            {{ number_format($month['requests']) }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>


    <div class="footer">

        Generated by Community Blood Donor Admin System

    </div>

</div>


<script>

    /*
     * Automatically open print dialog.
     *
     * User can choose:
     * "Save as PDF"
     */
    window.addEventListener('load', function () {

        setTimeout(function () {
            window.print();
        }, 500);

    });

</script>

</body>

</html>
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodRequest;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class ReportsController extends Controller
{
    /**
     * Display Reports & Statistics.
     */
    public function index(Request $request)
    {
        [$from, $to] = $this->getDateRange($request);

        $report = $this->buildReport($from, $to);

        return view('admin.reports.index', [
            'from' => $from->format('Y-m-d'),
            'to' => $to->format('Y-m-d'),

            'totalDonations' => $report['totalDonations'],
            'totalDonors' => $report['totalDonors'],
            'totalRequests' => $report['totalRequests'],
            'completedRequests' => $report['completedRequests'],
            'newDonors' => $report['newDonors'],

            'bloodTypeStats' => $report['bloodTypeStats'],
            'maxBloodTypeValue' => $report['maxBloodTypeValue'],

            'monthlyStats' => $report['monthlyStats'],
        ]);
    }


    /**
     * Generate Report.
     */
    public function generate(Request $request)
    {
        [$from, $to] = $this->getDateRange($request);

        $report = $this->buildReport($from, $to);

        return view('admin.reports.index', [
            'from' => $from->format('Y-m-d'),
            'to' => $to->format('Y-m-d'),

            'totalDonations' => $report['totalDonations'],
            'totalDonors' => $report['totalDonors'],
            'totalRequests' => $report['totalRequests'],
            'completedRequests' => $report['completedRequests'],
            'newDonors' => $report['newDonors'],

            'bloodTypeStats' => $report['bloodTypeStats'],
            'maxBloodTypeValue' => $report['maxBloodTypeValue'],

            'monthlyStats' => $report['monthlyStats'],

            'generated' => true,
        ]);
    }


    /**
     * Export report to CSV.
     *
     * CSV files can be opened using Microsoft Excel.
     */
    public function exportExcel(Request $request)
    {
        [$from, $to] = $this->getDateRange($request);

        $report = $this->buildReport($from, $to);

        $filename =
            'community-blood-donor-report-' .
            $from->format('Y-m-d') .
            '-to-' .
            $to->format('Y-m-d') .
            '.csv';

        return response()->streamDownload(function () use (
            $report,
            $from,
            $to
        ) {

            $handle = fopen('php://output', 'w');

            /*
             * UTF-8 BOM.
             * This helps Microsoft Excel display
             * the file correctly.
             */
            fwrite($handle, "\xEF\xBB\xBF");

            /*
             * TITLE
             */
            fputcsv($handle, [
                'COMMUNITY BLOOD DONOR'
            ]);

            fputcsv($handle, [
                'Reports & Statistics'
            ]);

            fputcsv($handle, [
                'Report Period',
                $from->format('F d, Y') .
                ' - ' .
                $to->format('F d, Y')
            ]);

            fputcsv($handle, []);

            /*
             * SUMMARY
             */
            fputcsv($handle, [
                'SUMMARY'
            ]);

            fputcsv($handle, [
                'Total Donations',
                $report['totalDonations']
            ]);

            fputcsv($handle, [
                'Registered Donors',
                $report['totalDonors']
            ]);

            fputcsv($handle, [
                'New Donors',
                $report['newDonors']
            ]);

            fputcsv($handle, [
                'Blood Requests',
                $report['totalRequests']
            ]);

            fputcsv($handle, [
                'Completed Requests',
                $report['completedRequests']
            ]);

            fputcsv($handle, []);

            /*
             * BLOOD TYPE
             */
            fputcsv($handle, [
                'DONATIONS BY BLOOD TYPE'
            ]);

            fputcsv($handle, [
                'Blood Type',
                'Donations'
            ]);

            foreach ($report['bloodTypeStats'] as $bloodType => $count) {

                fputcsv($handle, [
                    $bloodType,
                    $count
                ]);
            }

            fputcsv($handle, []);

            /*
             * MONTHLY SUMMARY
             */
            fputcsv($handle, [
                'MONTHLY SUMMARY'
            ]);

            fputcsv($handle, [
                'Month',
                'Donations',
                'New Donors',
                'Blood Requests'
            ]);

            foreach ($report['monthlyStats'] as $month) {

                fputcsv($handle, [
                    $month['month'],
                    $month['donations'],
                    $month['new_donors'],
                    $month['requests']
                ]);
            }

            fclose($handle);

        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }


    /**
     * Export report as a printable PDF page.
     *
     * The browser print dialog allows the user
     * to select "Save as PDF".
     */
    public function exportPdf(Request $request)
    {
        [$from, $to] = $this->getDateRange($request);

        $report = $this->buildReport($from, $to);

        return view('admin.reports.pdf', [
            'from' => $from,
            'to' => $to,

            'totalDonations' => $report['totalDonations'],
            'totalDonors' => $report['totalDonors'],
            'totalRequests' => $report['totalRequests'],
            'completedRequests' => $report['completedRequests'],
            'newDonors' => $report['newDonors'],

            'bloodTypeStats' => $report['bloodTypeStats'],
            'monthlyStats' => $report['monthlyStats'],
        ]);
    }


    /**
     * Get the selected date range.
     */
    private function getDateRange(Request $request): array
    {
        try {

            /*
             * Default:
             * First day of current month
             * through last day of current month
             */
            $from = $request->filled('from')
                ? Carbon::parse($request->input('from'))->startOfDay()
                : Carbon::now()->startOfMonth();

            $to = $request->filled('to')
                ? Carbon::parse($request->input('to'))->endOfDay()
                : Carbon::now()->endOfMonth();

            /*
             * If the user selects the dates backwards,
             * automatically correct the order.
             */
            if ($from->greaterThan($to)) {

                [$from, $to] = [$to, $from];

                $from->startOfDay();
                $to->endOfDay();
            }

        } catch (\Throwable $e) {

            /*
             * Safe fallback if an invalid date
             * is entered.
             */
            $from = Carbon::now()->startOfMonth();

            $to = Carbon::now()->endOfMonth();
        }

        return [$from, $to];
    }


    /**
     * Build the complete report.
     */
    private function buildReport(
        Carbon $from,
        Carbon $to
    ): array {

        /*
         * =====================================================
         * DONORS
         * =====================================================
         */

        $totalDonors = Donor::count();

        $newDonors = Donor::whereBetween(
            'created_at',
            [
                $from,
                $to
            ]
        )->count();


        /*
         * =====================================================
         * BLOOD REQUESTS
         * =====================================================
         */

        $totalRequests = BloodRequest::whereBetween(
            'created_at',
            [
                $from,
                $to
            ]
        )->count();


        /*
         * Completed / fulfilled requests.
         */
        $completedRequests = BloodRequest::where(
            'status',
            'fulfilled'
        )
            ->whereBetween(
                'updated_at',
                [
                    $from,
                    $to
                ]
            )
            ->count();


        /*
         * =====================================================
         * DONATIONS
         * =====================================================
         *
         * We first check if the donations table exists.
         *
         * This prevents the Reports page from crashing if
         * your donations table is not available yet.
         */

        $totalDonations = 0;

        if (Schema::hasTable('donations')) {

            $query = DB::table('donations');

            $dateColumn = $this->findColumn(
                'donations',
                [
                    'donation_date',
                    'date',
                    'donated_at',
                    'created_at'
                ]
            );

            $statusColumn = $this->findColumn(
                'donations',
                [
                    'status'
                ]
            );

            /*
             * Date filtering.
             */
            if ($dateColumn) {

                $query->whereBetween(
                    $dateColumn,
                    [
                        $from,
                        $to
                    ]
                );
            }


            /*
             * Only completed/successful donations
             * when a status column exists.
             */
            if ($statusColumn) {

                $query->whereIn(
                    $statusColumn,
                    [
                        'completed',
                        'complete',
                        'successful',
                        'success',
                        'fulfilled'
                    ]
                );
            }


            $totalDonations = $query->count();
        }


        /*
         * =====================================================
         * BLOOD TYPES
         * =====================================================
         */

        $bloodTypes = [
            'A+',
            'A-',
            'B+',
            'B-',
            'AB+',
            'AB-',
            'O+',
            'O-'
        ];

        $bloodTypeStats = [];

        foreach ($bloodTypes as $bloodType) {

            $bloodTypeStats[$bloodType] = 0;
        }


        /*
         * If donations table exists, calculate
         * the actual blood type distribution.
         */
        if (Schema::hasTable('donations')) {

            $bloodTypeColumn = $this->findColumn(
                'donations',
                [
                    'blood_type'
                ]
            );

            $dateColumn = $this->findColumn(
                'donations',
                [
                    'donation_date',
                    'date',
                    'donated_at',
                    'created_at'
                ]
            );

            $statusColumn = $this->findColumn(
                'donations',
                [
                    'status'
                ]
            );


            if ($bloodTypeColumn) {

                $query = DB::table('donations');


                /*
                 * Date filter.
                 */
                if ($dateColumn) {

                    $query->whereBetween(
                        $dateColumn,
                        [
                            $from,
                            $to
                        ]
                    );
                }


                /*
                 * Completed donations.
                 */
                if ($statusColumn) {

                    $query->whereIn(
                        $statusColumn,
                        [
                            'completed',
                            'complete',
                            'successful',
                            'success',
                            'fulfilled'
                        ]
                    );
                }


                $rows = $query
                    ->select(
                        $bloodTypeColumn,
                        DB::raw('COUNT(*) as total')
                    )
                    ->whereNotNull($bloodTypeColumn)
                    ->groupBy($bloodTypeColumn)
                    ->get();


                foreach ($rows as $row) {

                    $type = $row->{$bloodTypeColumn};

                    if (array_key_exists(
                        $type,
                        $bloodTypeStats
                    )) {

                        $bloodTypeStats[$type] =
                            (int) $row->total;
                    }
                }
            }
        }


        /*
         * =====================================================
         * MONTHLY REPORT
         * =====================================================
         */

        $monthlyStats = [];

        $current = $from
            ->copy()
            ->startOfMonth();

        $last = $to
            ->copy()
            ->startOfMonth();


        while (
            $current->lessThanOrEqualTo($last)
        ) {

            $monthStart = $current
                ->copy()
                ->startOfMonth();

            $monthEnd = $current
                ->copy()
                ->endOfMonth();


            /*
             * Don't go outside selected period.
             */
            if ($monthStart->lessThan($from)) {

                $monthStart = $from->copy();
            }


            if ($monthEnd->greaterThan($to)) {

                $monthEnd = $to->copy();
            }


            /*
             * New donors.
             */
            $monthDonors = Donor::whereBetween(
                'created_at',
                [
                    $monthStart,
                    $monthEnd
                ]
            )->count();


            /*
             * Blood requests.
             */
            $monthRequests = BloodRequest::whereBetween(
                'created_at',
                [
                    $monthStart,
                    $monthEnd
                ]
            )->count();


            /*
             * Donations.
             */
            $monthDonations = 0;


            if (Schema::hasTable('donations')) {

                $query = DB::table('donations');

                $dateColumn = $this->findColumn(
                    'donations',
                    [
                        'donation_date',
                        'date',
                        'donated_at',
                        'created_at'
                    ]
                );

                $statusColumn = $this->findColumn(
                    'donations',
                    [
                        'status'
                    ]
                );


                if ($dateColumn) {

                    $query->whereBetween(
                        $dateColumn,
                        [
                            $monthStart,
                            $monthEnd
                        ]
                    );


                    if ($statusColumn) {

                        $query->whereIn(
                            $statusColumn,
                            [
                                'completed',
                                'complete',
                                'successful',
                                'success',
                                'fulfilled'
                            ]
                        );
                    }


                    $monthDonations =
                        $query->count();
                }
            }


            $monthlyStats[] = [
                'month' => $current->format('F Y'),

                'donations' => $monthDonations,

                'new_donors' => $monthDonors,

                'requests' => $monthRequests,
            ];


            /*
             * Move to next month.
             */
            $current->addMonth();
        }


        /*
         * =====================================================
         * BLOOD TYPE BAR MAXIMUM
         * =====================================================
         */

        $maxBloodTypeValue = max(
            1,
            max($bloodTypeStats)
        );


        /*
         * =====================================================
         * RETURN REPORT DATA
         * =====================================================
         */

        return [

            'totalDonations' => $totalDonations,

            'totalDonors' => $totalDonors,

            'totalRequests' => $totalRequests,

            'completedRequests' => $completedRequests,

            'newDonors' => $newDonors,

            'bloodTypeStats' => $bloodTypeStats,

            'maxBloodTypeValue' => $maxBloodTypeValue,

            'monthlyStats' => $monthlyStats,

        ];
    }


    /**
     * Find the first existing column from a list.
     */
    private function findColumn(
        string $table,
        array $possibleColumns
    ): ?string {

        foreach ($possibleColumns as $column) {

            if (
                Schema::hasColumn(
                    $table,
                    $column
                )
            ) {

                return $column;
            }
        }

        return null;
    }
}
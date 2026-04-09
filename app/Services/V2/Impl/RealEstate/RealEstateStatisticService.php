<?php

namespace App\Services\V2\Impl\RealEstate;

use App\Repositories\Interfaces\TeamRepositoryInterface as TeamRepo;
use App\Repositories\Interfaces\ServiceRepositoryInterface as ServiceRepo;
use App\Repositories\Interfaces\PartnerRepositoryInterface as PartnerRepo;
use App\Repositories\Interfaces\AchievementRepositoryInterface as AchievementRepo;
use App\Repositories\RealEstate\VisitRequestRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RealEstateStatisticService
{
    protected $teamRepo;
    protected $serviceRepo;
    protected $partnerRepo;
    protected $achievementRepo;
    protected $visitRequestRepo;

    public function __construct(
        TeamRepo $teamRepo,
        ServiceRepo $serviceRepo,
        PartnerRepo $partnerRepo,
        AchievementRepo $achievementRepo,
        VisitRequestRepo $visitRequestRepo
    ) {
        $this->teamRepo = $teamRepo;
        $this->serviceRepo = $serviceRepo;
        $this->partnerRepo = $partnerRepo;
        $this->achievementRepo = $achievementRepo;
        $this->visitRequestRepo = $visitRequestRepo;
    }

    public function getStats()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        // Counts
        $teamCount = $this->teamRepo->all()->count();
        $serviceCount = $this->serviceRepo->all()->count();
        $partnerCount = $this->partnerRepo->all()->count();
        $achievementCount = $this->achievementRepo->all()->count();
        $visitRequestCount = $this->visitRequestRepo->all()->count();

        // Growth for Visit Requests
        $currentMonthVR = $this->visitRequestRepo->findByCondition([
            ['created_at', '>=', $startOfMonth]
        ], true)->count();

        $lastMonthVR = $this->visitRequestRepo->findByCondition([
            ['created_at', '>=', $startOfLastMonth],
            ['created_at', '<=', $endOfLastMonth]
        ], true)->count();

        $growth = 0;
        if ($lastMonthVR > 0) {
            $growth = (($currentMonthVR - $lastMonthVR) / $lastMonthVR) * 100;
        } elseif ($currentMonthVR > 0) {
            $growth = 100;
        }

        return [
            'teamCount' => $teamCount,
            'serviceCount' => $serviceCount,
            'partnerCount' => $partnerCount,
            'achievementCount' => $achievementCount,
            'visitRequestCount' => $visitRequestCount,
            'currentMonthVR' => $currentMonthVR,
            'lastMonthVR' => $lastMonthVR,
            'growth' => round($growth, 2),
            'vrChart' => $this->getVRChartData()
        ];
    }

    public function getVRChartData($type = 1)
    {
        $labels = [];
        $datasets = [];

        if ($type == 1) { // Annual (by month)
            for ($i = 1; $i <= 12; $i++) {
                $labels[] = "Tháng $i";
                $datasets[] = $this->visitRequestRepo->findByCondition([
                    [DB::raw('MONTH(created_at)'), '=', $i],
                    [DB::raw('YEAR(created_at)'), '=', date('Y')]
                ], true)->count();
            }
        }

        return [
            'label' => $labels,
            'data' => $datasets
        ];
    }

    public function getRecentVisitRequests($limit = 10)
    {
        return $this->visitRequestRepo->findByCondition([], true, ['properties'], ['id', 'DESC'])->take($limit);
    }
}

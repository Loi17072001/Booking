<?php

namespace App\Console\Commands;

use App\Http\Services\ScheduleService;
use App\Laravue\Models\School;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetDanhSachNguoiLuuTruCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nguoiluutru:auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Danh Sach nguoi luu tru tu ben thu 3';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schools = School::all();
        foreach ($schools as $school) {
            $scheduleService = new ScheduleService();
            if ($school->auto_get_schedule) {
                if ($school->schedule_run_date != Carbon::now()->format('Y-m-d')) {
                    Log::info('Get Automatic Schedule Of School: '. $school->name);
                    $scheduleService->getSchedule($school);
                }
            }

        }

    }
}

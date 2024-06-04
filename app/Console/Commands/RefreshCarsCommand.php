<?php

namespace App\Console\Commands;

use App\Models\Car;
use Illuminate\Console\Command;

class RefreshCarsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cars = Car::with([
            'rents' => function ($query) {
                $query->whereDate('start_at', '=', date('Y-m-d', strtotime("-1 days")));
            },
            'rents.driver',
        ])->get();

        foreach ($cars as $car) {
            $yesterdayRent = $car->yesterdayRent();

            if ($yesterdayRent->isNotEmpty() && $car->todayRent()->isEmpty()) {
                $lastYesterdayRent = $yesterdayRent->sortByDesc('start_at')->first();
                $newRent = $lastYesterdayRent->replicate();
                $newRent->start_at = $lastYesterdayRent->start_at->addDay();
                $newRent->end_at = null;
                $newRent->amount = $car->amount;
                $newRent->save();
            }

            $car->update(['status' => Car::EMPTY]);
            $car->save();
        }
    }
}

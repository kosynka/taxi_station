<?php

namespace App\Http\Middleware;

use App\Models\Car;
use App\Models\Rent;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefreshCars
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cars = Car::with([
            'rents' => function ($query) {
                $query->whereDate('start_at', '=', date('Y-m-d', strtotime("-1 days")));
            }, 
            'rents.driver',
            ])->get();

        foreach ($cars as $car) {
            $yesterdayRent = $car->yesterdayRent();

            if ($yesterdayRent !== null && $car->todayRent() === null) {
                $newRent = $yesterdayRent->replicate();
                $newRent->start_at = now();
                $newRent->end_at = null;
                $newRent->amount = $car->amount;
                $newRent->save();

                if ($car->status === Car::PASSED) {
                    $car->update(['status' => Car::EMPTY]);
                    $car->save();
                }
            }
        }

        return $next($request);
    }
}

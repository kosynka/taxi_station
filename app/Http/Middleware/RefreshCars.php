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
        $rents = Rent::whereDate('start_at', '=', now()->toDateString())->get();

        if ($rents->count() === 0) {
            $cars = Car::where('status', Car::ON_RENT)->get();

            foreach ($cars as $car) {
                $car->update(['status' => Car::EMPTY]);
                $car->save();
            }
        }

        return $next($request);
    }
}

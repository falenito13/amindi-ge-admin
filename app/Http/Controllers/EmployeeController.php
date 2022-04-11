<?php

namespace App\Http\Controllers;

use App\CheckIn;
use App\CheckOut;
use App\Http\Requests\CheckInRequest;
use App\Http\Requests\CheckOutRequest;
use App\Http\Requests\WorkStatusRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    const CHECK_IN = 1;
    const CHECK_OUT = 2;
    const NOT_AVAILABLE_WORKING = 3;
    const DIFFERENCE_WORK_FREEDOM_MINS = 720;

    /**
     * Checks if employee currently working , not working or can work
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */

    public function workStatus(WorkStatusRequest $request): Response
    {
        $checkIn = CheckIn::latest()->where('name', $request->name);
        if ($checkIn->exists()) {
            $checkOut = CheckOut::where('check_in_id', $checkIn->first()->id);
            if ($checkOut->exists()) {
                if (now()->diffInMinutes($checkOut->first()->finish_time) > self::DIFFERENCE_WORK_FREEDOM_MINS - 1) {
                    return response(self::CHECK_IN);
                }
                return response(self::NOT_AVAILABLE_WORKING);
            } else {
                return response(self::CHECK_OUT);
            }
        } else {
            return response(self::CHECK_IN);
        }
    }

    /**
     * Employee check in
     * @param CheckInRequest $request
     * @return Response
     */
    public function checkIn(CheckInRequest $request): Response
    {
        CheckIn::create($request->validated());
        return response(self::CHECK_OUT, Response::HTTP_CREATED);
    }

    /**
     * Employee check out
     * @param CheckOutRequest $request
     * @return Response
     */

    public function checkOut(CheckOutRequest $request): Response
    {
        $checkIn = CheckIn::latest()->where('name', $request->name)->first();
        CheckOut::create([
            'check_in_id' => $checkIn->id,
            'finish_time' => now()
        ]);
        return response(self::NOT_AVAILABLE_WORKING, Response::HTTP_CREATED);
    }
}

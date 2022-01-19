<?php

namespace App\Http\Controllers\api\v1;


use App\Http\Controllers\BaseController as BaseController;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use Carbon\Carbon;


class BookingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return $this->sendResponse(BookingResource::collection($bookings), 'Bookings retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        $input = $request->validated();

        $date = $input['date'];
        $hour = $input['hour'];
        $contact_name = $input['contact_name'];
        $contact_email = $input['contact_email'];

        if($this->isItOnTime($date, $hour) && $this->isThisAnAvailableHour($date, $hour)){
            $booking = Booking::create($input);
            return $this->sendResponse(new BookingResource($booking), 'Booking created successfully :).');         
        }
        else{
            return $this->sendError('Validation Error', 'Maybe you\'re trying to take an hour that has already passed or the hour is booked by someone else.');      
        }    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::find($id);
  
        if (is_null($booking)) {
            return $this->sendError('Booking not found.');
        }
   
        return $this->sendResponse(new BookingResource($booking), 'Booking retrieved successfully.');        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBookingRequest $request, Booking $booking)
    {
        $input = $request->validated();
        
        $booking->date = $input['date'];
        $booking->hour = $input['hour'];
        $booking->contact_name = $input['contact_name'];
        $booking->contact_email = $input['contact_email'];

        if($this->isItOnTime($booking->date, $booking->hour) && $this->isThisAnAvailableHour($booking->date, $booking->hour, $booking->id)){
            $booking->save();
            return $this->sendResponse(new BookingResource($booking), 'Booking created Updated :).');         
        }
        else{
            return $this->sendError('Validation Error', 'Maybe you\'re trying to take an hour that has already passed or the hour is booked by someone else.');      
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();   
        return $this->sendResponse([], 'Booking deleted successfully.');
    }


    // CUSTOM METHODS

    /**
     * Display a listing of the resource by date.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBookingsByDate($date)
    {
        $bookings = Booking::where('date', $date)->orderBy('hour')->get();
        return $this->sendResponse(BookingResource::collection($bookings), 'Bookings '.$date.' retrieved successfully.');
    }      


    /**
     * Display a listing of the resource by date.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOpeningHours()
    {        
        return $this->sendResponse([config('app.workday_start_time'), config('app.workday_end_time')], 'Range retrieved successfully.');
    }      


    public function isThisAnAvailableHour($date, $hour, $id = 0)
    {
        if($id == 0){
            // Under creation
            $query = Booking::where('date', $date)->where('hour', $hour);
        }
        else{
            // In update // TODO I am not sure about this
            $query = Booking::where('date', $date)->where('hour', $hour)->where('id', "<>", $id);
        }
                    
        return $query->count() == 0;
    }


    public function isItOnTime($date, $hour)
    {
        // Booking Date/Hour          
        $hour = $hour < 10 ? '0'.$hour.':00' : $hour.':00';
        $datetime_appointment = new Carbon($date." ".$hour, new \DateTimeZone('America/Santiago'));

        // Server Date/Hour
        $datetime_now =  Carbon::now(new \DateTimeZone('America/Santiago'));

        // No se puede agendar horas para el pasado 
        return $datetime_now->diffInMinutes($datetime_appointment, false) > 1;
         
    }

}

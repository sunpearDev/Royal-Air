<?php
require_once('dbService.php');
class Booking extends DbServices
{
    function getUserBooking($token)
    {
        $res = [];
        $user_booking = $this->getBy("booking", ['name' => 'user_id', 'value' => $this->decrypt($token)]);
        foreach ($user_booking as $item) {
            $res[] = $this->getMultiTable([0 => 'booking', 1 => 'booking_detail'], ['name' => 'booking_ID', 'value' => $item['booking_ID']]);
        }
        for ($i = 0; $i < count($res); $i++) {
            $res[$i] = $res[$i][0];
        }
        return $res;
    }
    function book($booking_info, $booking_detail)
    {
        //decrypt token
        $booking_info['user_id'] = $this->decrypt($booking_info['user_id']);
        try {
            $this->beginTransaction();
            //create booking*
            $res = $this->create("booking", $booking_info);
            if (!$res) {
                $this->rollBack();
                return ['message' => "Booking false!", "status" => false];
            }

            $res = $this->getBy("room_category", ['name' => 'category_ID', 'value' => $booking_detail['category_ID']]);

            //get available for set 
            $available = $res[0]['available'];

            //set price for booking detail
            $booking_detail['price_on_day'] = $res[0]['price_on_day'];

            //update total pay in booking*
            $res = $this->update("booking", ['name' => 'booking_ID', 'value' => $booking_info['booking_ID']], ['total_pay' => $booking_detail['quantity'] * $res[0]['price_on_day']]);
            if (!$res) {
                $this->rollBack();
                return ['message' => "Booking false!", "status" => false];
            }

            //create booking detail*
            $res = $this->create("booking_detail", $booking_detail);
            if (!$res) {
                $this->rollBack();
                return ['message' => "Booking false!", "status" => false];
            }

            //get all room of category
            $res = $this->getBy("room", ['name' => 'category_ID', 'value' => $booking_detail['category_ID']]);

            //filter available room
            $room_available = [];
            foreach ($res as $item) {
                if (!$item['state']) {
                    $room_available[] = $item;
                }
            }

            for ($i = 0; $i < $booking_detail['quantity']; $i++) {
                //update room*
                $res = $this->update("room", ['name2' => 'room_number', 'value2' => $room_available[$i]['room_number'], 'name1' => 'category_ID', 'value1' => $booking_detail['category_ID']], ['state' => 1]);
                if (!$res) {
                    $this->rollBack();
                    return ['message' => "Booking false!", "status" => false];
                }
            }

            //set again available of category*
            $res = $this->update("room_category", ['name' => 'category_ID', 'value' => $booking_detail['category_ID']], ['available' => ($available - $booking_detail['quantity'])]);
            if (!$res) {
                $this->rollBack();
                return ['message' => "Booking false!", "status" => false];
            }



            $this->commit();
            return ['message' => "Booking success!", "status" => true];
        } catch (\Throwable $e) {

            $this->rollBack();
            throw $e;
        }
    }
}

<?php
require_once('dbService.php');
class Booking extends DbServices
{
    function book($booking_info, $booking_detail)
    {
        $this->beginTransaction();
        try {
            $res = $this->create("booking", $booking_info);
            if ($res) {
                $res1 = $this->getBy("room_category", ['name' => 'category_ID', 'value' => $booking_detail['category_ID']]);
                $booking_detail['price_on_day'] = $res1[0]['price_on_day'];
                $res2 = $this->create("booking_detail", $booking_detail);
                if ($res2) {
                    $res3 = $this->update("room_category", ['name' => 'category_ID', 'value' => $booking_detail['category_ID']], ['available' => ($res1['available'] - 1)]);
                    if ($res3) {
                        $this->commit();
                        return ['message' => "Booking success!", "status" => true];
                    }
                }
            }
            $this->rollBack();
            return ['message' => "Booking false!", "status" => false];
        } catch (\Throwable $e) {

            $this->rollBack();
            throw $e;
        }
    }
}

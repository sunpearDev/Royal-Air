
<form class="hotel_booking_area" method="get" action="../../booking.php">
    <div class="container">
        <div class="row hotel_booking_table">
            <div class="col-md-3">
                <h2>Book<br> Your Room</h2>
            </div>
            <div class="col-md-9">
                <div class="boking_table">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="book_tabel_item">
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker11'>
                                        <input type='text' name="dateArrival" class="form-control" placeholder="Arrival Date" value="<?php if (isset($_GET['dateArrival'])) echo $_GET['dateArrival'];
                                        else echo ''?>"/> 
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' name="departureDate" class="form-control" placeholder="Departure Date" value="<?php if (isset($_GET['departureDate'])) echo $_GET['departureDate'];
                                        else echo ''?>"/>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="book_tabel_item">
                                <div class="input-group">
                                    <select class="wide" name='adult' value="<?php if (isset($_GET['adult'])) echo $_GET['adult'];
                                        else echo 0?>">
                                        <option data-display="Adult" value="0">Adult</option>
                                        <option value="1">1 Adult</option>
                                        <option value="2">2 Adult</option>
                                        <option value="3">3 Adult</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <select class="wide" name="child" value="<?php if (isset($_GET['child'])) echo $_GET['child'];
                                        else echo 0?>">
                                        <option data-display="Child" value="0">Child</option>
                                        <option value="1">1 Child</option>
                                        <option value="2">2 Child</option>
                                        <option value="3">3 Child</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="book_tabel_item">
                                <div class="input-group">
                                    <select class="wide" name="room">
                                        <option data-display="ROOM" >Number of Rooms</option>
                                        <option value="1">Room 01</option>
                                        <option value="2">Room 02</option>
                                        <option value="3">Room 03</option>
                                    </select>
                                </div>
                                <button type="submit" class="book_now_btn button_hover">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
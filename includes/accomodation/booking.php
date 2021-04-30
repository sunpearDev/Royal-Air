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
                                                                                                                                        else echo '' ?>" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' name="departureDate" class="form-control" placeholder="Departure Date" value="<?php if (isset($_GET['departureDate'])) echo $_GET['departureDate'];
                                                                                                                                            else echo '' ?>" />
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
                                    <select class="wide" name='adult'>
                                        <option data-display="Adult" value="0">Adult</option>
                                        <option value="1" <?php if(isset($_GET['adult'])) if ($_GET['adult'] == 1) echo 'selected' ?>>1 Adult</option>
                                        <option value="2" <?php if(isset($_GET['adult'])) if ($_GET['adult'] == 2) echo 'selected' ?>>2 Adult</option>
                                        <option value="3" <?php if(isset($_GET['adult'])) if ($_GET['adult'] == 3) echo 'selected' ?>>3 Adult</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <select class="wide" name="child">
                                        <option data-display="Child" value="0">Child</option>
                                        <option value="1" <?php if(isset($_GET['adult'])) if ($_GET['child'] == 1) echo 'selected' ?>>1 Child</option>
                                        <option value="2" <?php if(isset($_GET['adult'])) if ($_GET['child'] == 2) echo 'selected' ?>>2 Child</option>
                                        <option value="3" <?php if(isset($_GET['adult'])) if ($_GET['child'] == 3) echo 'selected' ?>>3 Child</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 align-self-center">
                                <button type="submit" class="book_now_btn button_hover">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
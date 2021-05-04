<form class="hotel_booking_area" method="post" action="<?php if (isset($_COOKIE['token'])) echo './booking.php';
                                                        else echo './login'; ?>">
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
                                        <input type='text' name="check_in" class="form-control" placeholder="Arrival Date" value="<?php if (isset($_POST['check_in'])) echo $_POST['check_in'];
                                                                                                                                    else echo '' ?>" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' name="check_out" class="form-control" placeholder="Departure Date" value="<?php if (isset($_POST['check_out'])) echo $_POST['check_out'];
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
                                        <option value="1" <?php if (isset($_POST['adult'])) if ($_POST['adult'] == 1) echo 'selected' ?>>1 Adult</option>
                                        <option value="2" <?php if (isset($_POST['adult'])) if ($_POST['adult'] == 2) echo 'selected' ?>>2 Adult</option>
                                        <option value="3" <?php if (isset($_POST['adult'])) if ($_POST['adult'] == 3) echo 'selected' ?>>3 Adult</option>
                                        <option value="4" <?php if (isset($_POST['adult'])) if ($_POST['adult'] == 4) echo 'selected' ?>>4 Adult</option>
                                        <option value="4" <?php if (isset($_POST['adult'])) if ($_POST['adult'] == 5) echo 'selected' ?>>5 Adult</option>
                                        <option value="4" <?php if (isset($_POST['adult'])) if ($_POST['adult'] == 6) echo 'selected' ?>>6 Adult</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <select class="wide" name="child">
                                        <option data-display="Child" value="0">Child</option>
                                        <option value="1" <?php if (isset($_POST['child'])) if ($_POST['child'] == 1) echo 'selected' ?>>1 Child</option>
                                        <option value="2" <?php if (isset($_POST['child'])) if ($_POST['child'] == 2) echo 'selected' ?>>2 Child</option>
                                        <option value="3" <?php if (isset($_POST['child'])) if ($_POST['child'] == 3) echo 'selected' ?>>3 Child</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="book_tabel_item">
                                <div class="input-group">
                                    <select class="wide" name="quantity">
                                        <option data-display="Amount of room" value="0">Room</option>
                                        <option value="1" <?php if (isset($_POST['quantity'])) if ($_POST['quantity'] == 1) echo 'selected' ?>>1 Room</option>
                                        <option value="2" <?php if (isset($_POST['quantity'])) if ($_POST['quantity'] == 2) echo 'selected' ?>>2 Room</option>
                                        <option value="3" <?php if (isset($_POST['quantity'])) if ($_POST['quantity'] == 3) echo 'selected' ?>>3 Room</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="book_now_btn button_hover">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</form>
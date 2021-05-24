<?php /*This project is mainly focus on Logged In users access their tickets history and requesting support thru chat with the staff*/
/*This page can be used for future approach.*/ ?>
<?php require './view/header.php'; ?>
<main class=" flex-grow-1 p-2">
    <h2 class="text-center my-3 pt-3">Sign Up</h2>
    <div class="container mt-5 my-5">
        <div class="row justify-content-center align-items-center">
            <form id="signup_form" name="signup_form" class="form" action="" method="POST">
                <div class="mb-3 form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" class="form-control" placeholder="Type your username">
                </div>
                <div class="mb-3 form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" class="form-control" placeholder="Type your password">
                </div>
                <div class="mb-3 form-group">
                    <label for="reset_Password">Re-confirm password:</label>
                    <input type="password" id="reset_Password" class="form-control" placeholder="Re-type your password">
                </div>
                <div class="mb-3 form-group">
                    <label for="fname">First name:</label>
                    <input type="text" id="fname" class="form-control" placeholder="Type your first name">
                </div>
                <div class="mb-3 form-group">
                    <label for="lname">Last name:</label>
                    <input type="text" id="lname" class="form-control" placeholder="Type your last name">
                </div>
                <div class="mb-3 form-group">
                    <label for="email">Email Address:</label>
                    <input type="text" id="email" class="form-control" placeholder="Type your email">
                </div>
                <div class="mb-3 form-group">
                    <label for="pNumber">Phone Number:</label>
                    <input type="text" id="pNumber" class="form-control" placeholder="Type your phone number">
                </div>
                <div class="mb-3 form-group">
                    <fieldset>
                        <legend class="text-left my-3 pt-3">Address</legend>
                        <div class="mb-3 pt-2 form-group">
                            <label for="streetAdd">Street address:</label>
                            <input type="text" id="streetAdd" name="streetAdd" class="form-control"
                                   placeholder="123 John Street">
                        </div>
                        <div class="mb-3 pt-2 form-group">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" class="form-control" placeholder="e.g. Toronto">
                        </div>
                        <div class="mb-3 pt-2 form-group">
                            <label for="province">Province:</label>
                            <select name="province" id="province" class="form-control">
                                <option value="AB">Alberta</option>
                                <option value="BC">British Columbia</option>
                                <option value="MB">Manitoba</option>
                                <option value="NB">New Brunswick</option>
                                <option value="NL">Newfoundland and Labrador</option>
                                <option value="NT">Northwest Territories</option>
                                <option value="NS">Nova Scotia</option>
                                <option value="NU">Nunavut</option>
                                <option value="ON">Ontario</option>
                                <option value="PE">Prince Edward Island</option>
                                <option value="QC">Quebec</option>
                                <option value="SK">Saskatchewan</option>
                                <option value="YT">Yukon</option>
                            </select>
                        </div>
                        <div class="mb-3 pt-2 form-group">
                            <label for="postalCode">Postal code:</label>
                            <input type="text" id="postalCode" class="form-control" name="postalCode"
                                   placeholder="A1A1A1">
                        </div>
                    </fieldset>
                </div>
                <div class="form-group text-center py-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?php require './view/footer.php'; ?>

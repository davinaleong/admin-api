Clear-Host

Set-Location "../application/tests"

# phpunit

# --- Controllers ---
# phpunit "./controllers"
# phpunit "./controllers/Api_authenticate_test.php"
# phpunit "./controllers/Api_personal_profile_test.php"
# phpunit "./controllers/Api_user_test.php"

# --- Models ---
# phpunit "./models"
# phpunit "./models/Access_right_model_test.php"
phpunit "./models/Account_status_model_test.php"
# phpunit "./models/Personal_profile_model_test.php"
# phpunit "./models/User_model_test.php"

Set-Location "../../bin"
cls

cd "../application/tests"

# --- Controllers ---
# phpunit "./controllers"
# phpunit "./controllers/Api_authenticate.php"
# phpunit "./controllers/Api_personal_profile.php"
# phpunit "./controllers/Api_user.php"

# --- Models ---
# phpunit "./models"
phpunit "./models/Access_right_model.php"
# phpunit "./models/Account_status_model.php"
# phpunit "./models/Personal_profile_model.php"
# phpunit "./models/User_model.php"

cd "../../bin"
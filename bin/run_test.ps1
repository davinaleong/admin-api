cls

cd "../application/tests"

# phpunit --no-coverage

# --- Controllers ---
# phpunit "./controllers" --no-coverage
# phpunit "./controllers/Api_authenticate_test.php" --no-coverage
# phpunit "./controllers/Api_personal_profile_test.php" --no-coverage
# phpunit "./controllers/Api_user_test.php" --no-coverage

# --- Models ---
# phpunit "./models" --no-coverage
phpunit "./models/Access_right_model_test.php" --no-coverage
# phpunit "./models/Account_status_model_test.php" --no-coverage
# phpunit "./models/Personal_profile_model_test.php" --no-coverage
# phpunit "./models/User_model_test.php" --no-coverage

cd "../../bin"
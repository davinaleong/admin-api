Clear-Host

Set-Location "../application/tests"

phpunit --no-coverage --filter "test_"

Set-Location "../../bin"
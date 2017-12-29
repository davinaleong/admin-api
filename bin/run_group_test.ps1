Clear-Host

Set-Location "../application/tests"

phpunit --no-coverage --group untested

Set-Location "../../bin"
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create hike</title>
</head>

<body>
    <h1>Create a new hike</h1>
    <form method="GET" action="read.php">
        <label for="name">Name </label>
        <input class="input is-medium" name="name" type="text" placeholder="Name">
        <label for="distance">Distance </label>
        <input class="input is-medium" name="distance" type="number" placeholder="Distance">
        <label for="duration">Duration </label>
        <input class="input is-medium" name="duration" type="number" placeholder="Duration in minutes">
        <label for="elevation">Elevation (+) </label>
        <input class="input is-medium" name="elevation" type="number" placeholder="Positive elevation">
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Easy">
                Easy
            </label>
        </div>
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Moderate">
                Moderate
            </label>
        </div>
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Hard">
                Hard
            </label>
        </div>
        <div class="control">
            <input type="submit" class="button is-link" value="submit">
        </div>



    </form>
</body>

</html>
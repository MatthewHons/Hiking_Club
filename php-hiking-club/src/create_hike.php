        <?php include 'header.php'; ?>

        <h1>Create a new hike</h1>
        <form method="post" action="addData.php">
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
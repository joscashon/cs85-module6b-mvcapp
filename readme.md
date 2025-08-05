Module 6B
=========

Reflection
----------

### Why you chose your topic
I chose to make a run tracker because I have been trying to get more consistent with my exercise habits lately, and I though that having a way to track my running streak along with various statistics might be helpful.

### What your app does
This app allows the user to input the data from their runs (date, mileage, time) and tracks their total time and mileage as well as their current/historical streak for consecutive days of running.

### What was the hardest part and why
The hardest part was honestly just getting the initial directory structure right and configuring composer.json accordingly.

Initially I had put the public folder inside of /src along with Views, Models, and Controllers, which caused a lot of server errors when I tried to access the page in my browser. So I moved all the /src subfolders to the project root, which resolved all the server errors and at least allowed me to confirm that my model, controller, view, and index php files were working correctly.

But then I re-read the assignment instructions more carefully and realized only /public was suppposed to be in the root folder along with /Views, while only /Controller and /Models were supposed to be in /src. I rearranged everything as such, but then got a bunch of server errors again upon testing.

Finally I was able to get it all working with the correct directory structure by setting the PSR-4 key in composer.json to `"User\\Cs85Module6bMvcapp\\": "src/"` instead of `"User\\Cs85Module6bMvcapp\\": "./".` Index.php also needed to be updated with `require_once __DIR__ . '/../vendor/autoload.php';` to match the new directory structure.

### What you learned about MVC

I learned a lot about MVC through this assignment, namely the unique role of the Model, View, and Controller files. Once I realized that all the business logic is conveniently centralized in the model file separately from the UI in the view file, a lightbulb kind of went off for me about how this delineation of responsibilities would make adding and updating additional functionalities much easier. 


AI critique
-----------

### Prompt:

Write another function to calculate the current streak on the day of a given individual run rather than from today

### Response:

Certainly! You can add a method like streakAtDate($date) to your Run class. This will calculate the streak ending on the given date (e.g., for any run in your history).

Here’s how you can implement it:

```
<?php
    // Calculate streak ending at a specific date (YYYY-MM-DD)
    public function streakAtDate($targetDate) {
        if (empty($this->runs)) return 0;
        // Collect unique dates up to and including $targetDate
        $dates = array_map(function($run) { return $run['date']; }, $this->runs);
        $dates = array_unique($dates);
        $dates = array_filter($dates, function($d) use ($targetDate) {
            return $d <= $targetDate;
        });
        if (empty($dates)) return 0;
        $dates = array_map(function($d) { return new \DateTime($d); }, $dates);
        usort($dates, function($a, $b) { return $b <=> $a; }); // Descending

        $streak = 0;
        $current = new \DateTime($targetDate);
        foreach ($dates as $date) {
            if ($date->diff($current)->days === $streak && $date <= $current) {
                $streak++;
            } else {
                break;
            }
        }
        return $streak;
}
```

Usage example:

```
<?php
// To get the streak for a specific run:
$run->streakAtDate($runDate);
```

This will return the streak (consecutive days) ending on the date you provide.

### Critique:

I was surprised, the code given in the output actually seems pretty decent! Everything seemed to work as-is without requiring any substantial changes. The one change I did make was adding htmlspecialchars sanitation to its usage example in run_view, as well as obviously removing the unneccessary redundant opening php tag it included at the beginning of the controller code block.
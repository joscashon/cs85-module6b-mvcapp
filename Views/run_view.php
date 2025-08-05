<h1>Fitness Run Tracker</h1>
<h2>Add a Run</h2>
<form method="post">
    <label>Date: <input type="date" name="date" required value="<?= date('Y-m-d') ?>"></label>
    <label>Miles: <input type="number" name="miles" step="0.01" min="0" required></label>
    <label>Minutes: <input type="number" name="minutes" min="0" required></label>
    <label>Seconds: <input type="number" name="seconds" min="0" max="59" required></label>
    <button type="submit">Add Run</button>
</form>
<h2>Run History</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Date</th>
        <th>Miles</th>
        <th>Minutes</th>
        <th>Seconds</th>
        <th>Pace (min/mile)</th>
        <th>Streak</th>
        <th>Action</th>
    </tr>
    <?php $i = 0; ?>
    <?php foreach ($run->runs as $r): ?>
    <tr>
        <td><?= htmlspecialchars($r['date']) ?></td>
        <td><?= htmlspecialchars($r['miles']) ?></td>
        <td><?= htmlspecialchars($r['minutes']) ?></td>
        <td><?= htmlspecialchars($r['seconds']) ?></td>
        <td><?= htmlspecialchars($run->paceForRun($r)) ?></td>
        <td><?= htmlspecialchars($run->streakAtDate($r['date'])) ?></td>
        <td>
            <form method="post" style="display:inline;">
                <button type="submit" name="delete" value="<?= $i ?>">Delete</button>
            </form>
        </td>
    </tr>
    <?php $i++; endforeach; ?>
</table>

<h2>Statistics</h2>
<strong>Current Streak: </strong> <?= htmlspecialchars($run->streak()) ?> days<br>
<strong>Total Runs: </strong> <?= htmlspecialchars($run->totalRuns()) ?><br>
<strong>Total Time Running: </strong> <?= htmlspecialchars($run->totalHours()) ?> hours<br>
<strong>Average Pace: </strong> <?= htmlspecialchars($run->averagePace()) ?> min/mile
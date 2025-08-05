<h1>Fitness Run Tracker</h1>
<table border="1" cellpadding="5">
    <tr>
        <th>Date</th>
        <th>Miles</th>
        <th>Minutes</th>
        <th>Seconds</th>
        <th>Pace (min/mile)</th>
    </tr>
    <?php foreach ($run->runs as $r): ?>
    <tr>
        <td><?= htmlspecialchars($r['date']) ?></td>
        <td><?= htmlspecialchars($r['miles']) ?></td>
        <td><?= htmlspecialchars($r['minutes']) ?></td>
        <td><?= htmlspecialchars($r['seconds']) ?></td>
        <td><?= htmlspecialchars($run->paceForRun($r)) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>Statistics</h2>
<strong>Current Streak: </strong> <?= htmlspecialchars($run->streak()) ?> days<br>
<strong>Average Pace: </strong> <?= htmlspecialchars($run->averagePace()) ?> min/mile
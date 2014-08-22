<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projects Timeline</title>
    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" type="text/css" href="<?= $application->publicBaseUri ?>/css/style.css" media="all"/>
</head>
<body>
    <h1>Projects Timeline</h1>
    <ol class="timeline">
    <?php foreach ($projectList as $project) : ?>
        <li class="timeline-node">
            <div class="timeline-stamp"><?= $project->stamp ?></div>
            <div class="timeline-content">
                <a href="?project=<?= $project->id ?>"><?= $project->name ?></a>
            </div>
        </li>
    <?php endforeach; ?>
    </ol>
</body>
</html>
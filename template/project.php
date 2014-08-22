<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $project->name ?> Timeline</title>
    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" type="text/css" href="<?= $application->publicBaseUri ?>/css/style.css" media="all"/>
</head>
<body>
    <?php if ($projectCount > 1) : ?>
        <div class="">
            <a href="/">All projects</a>
        </div>
    <?php endif; ?>
    <h1>
        <?= $project->name ?> Timeline
    </h1>
    <ol class="timeline">
    <?php foreach ($project->timeline as $note) : ?>
        <li class="timeline-node">
            <div class="timeline-stamp"><?= $note->stamp ?></div>
            <div class="timeline-content"><?= $note->content ?></div>
            <div class="timeline-links">
            <?php foreach ($note->links as $label => $href) : ?>
                <a href="<?= $href ?>"><?= $label ?></a>
            <?php endforeach; ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ol>
</body>
</html>
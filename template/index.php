<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[<?= $project->name ?>] Project Timeline</title>
    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" type="text/css" href="<?= $application->publicBaseUri ?>/css/style.css" media="all"/>
</head>
<body>
    <h1>[<?= $project->name ?>] Project Timeline</h1>
    <ol class="timeline">
    <?php foreach ($project->timeline as $note) { ?>
        <li class="tl-node">
            <div class="tl-stamp"><?= $note->stamp ?></div>
            <div class="tl-content"><?= $note->content ?></div>
            <div class="tl-links">
            <?php foreach ($note->links as $label => $href) { ?>
                <a href="<?= $href ?>"><?= $label ?></a>
            <?php } ?>
            </div>
        </li>
    <?php } ?>
    </ol>
</body>
</html>
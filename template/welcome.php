<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to ProjectHub</title>
    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" type="text/css" href="<?= $application->publicBaseUri ?>/css/style.css" media="all"/>
</head>
<body>
<h1>Welcome to ProjectHub</h1>
<p>You have no projects configured yet.</p>
<p>To setup your first project, you just have to create a file <code>data/example.json</code>. You can use the example data below:</p>
<pre><code>
{
    "name": "Project name",
    "timeline": [
        {
            "stamp": "August 14th, 2014",
            "content": "Meeting 2",
            "links": {
                "Link to meeting notes": "http://example.com/meeting-notes",
                "As many links as you want": "http://example.com/other-link",
            }
        },
        {
            "stamp": "August 9th, 2014",
            "content": "Meeting 1",
            "links": {
                "Link to notes, design or demo": "http://example.com/"
            }
        }
    ]
}
</code></pre>
</body>
</html>
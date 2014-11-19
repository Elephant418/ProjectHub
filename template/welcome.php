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
<p>To setup your first project, you just have to create a file <code>data/example.yml</code>. You can use the example data below:</p>
<pre><code>
name: "My first project"
timeline:
    -
        stamp: "August 14th, 2013"
        content: "Kickoff Meeting"
        links:
            "View notes": "#"
            "View demo": "#"
    -
        stamp: "August 9th, 2013"
        content: "Sign contract"
        links:
            "View contract": "#"
    -
        stamp: "August 7th, 2013"
        content: "Initial meeting"
        links:
            "Meeting Notes": "#"
    -
        stamp: "July 13th, 2013"
            content: "Initial contact"
</code></pre>
</body>
</html>
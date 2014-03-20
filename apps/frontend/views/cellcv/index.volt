<?php $this->tag->setDocType(\Phalcon\Tag::HTML5) ?>
{{ get_doctype() }}
<html>
    <head>
        {{ partial("partials/head") }}
    </head>
    <body class="{{ controllerName }}-{{ actionName }}">
        <div id="page-wrapper">
            <div id="header" role="banner">
                {{ partial("partials/header") }}
            </div>
            <div id="messages">
                {{ partial("partials/messages") }}
            </div>
            <div id="main">
                {{ content() }}
            </div>
            <footer id="footer" role="contentinfo">
                {{ partial("partials/footer") }}
            </footer>
        </div>
    </body>
</html>
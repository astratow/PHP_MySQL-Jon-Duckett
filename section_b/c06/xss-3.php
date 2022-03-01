<a class="badlink" href="xss-3.php?msg=<script src=js/bad.js></script>">
  ESCAPING MARKUP</a>

<?php
function html_escape(string $string): string
{
    return htmlspecialchars($string,
        ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
}

$message = $_GET['msg'] ?? 'Click the link above';
?>
<?php include 'includes/header.php' ?>

<h1>XSS Example</h1>
<p><?= html_escape($message) ?></p>

<?php include 'includes/footer.php' ?>
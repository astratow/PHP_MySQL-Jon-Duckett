<?php
  function html_escape(string $string): string
  {
    return htmlspecialchars($string, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
  }
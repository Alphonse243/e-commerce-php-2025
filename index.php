<?php
require_once 'autoload.php';

$page = new Page("Karma Shop - Home");
$homePage = new HomePage();

// Set the content
$page->setContent($homePage->render());

// Render the page
$page->render();

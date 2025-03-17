<?php

class Page {
    protected string $title;
    protected string $content;

    public function __construct(string $title = 'Karma Shop') {
        $this->title = $title;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function render(): void {
        ?>
        <!DOCTYPE html>
        <html lang="zxx" class="no-js">
        <head>
            <!-- Mobile Specific Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Favicon-->
            <link rel="shortcut icon" href="img/fav.png">
            <!-- Meta Description -->
            <meta name="description" content="">
            <!-- Meta Keyword -->
            <meta name="keywords" content="">
            <!-- meta character set -->
            <meta charset="UTF-8">
            <!-- Site Title -->
            <title><?= htmlspecialchars($this->title) ?></title>
            
            <!-- CSS Files -->
            <?php (new Assets())->renderCss(); ?>
        </head>
        <body>
            <?php (new Navigation())->render(); ?>
            
            <?= $this->content ?>

            <?php (new Footer())->render(); ?>
            
            <!-- JavaScript Files -->
            <?php (new Assets())->renderJs(); ?>
        </body>
        </html>
        <?php
    }
}

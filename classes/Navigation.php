<?php

class Navigation {
    private array $menuItems = [
        'home' => [
            'title' => 'Home',
            'url' => 'index.html',
            'active' => true
        ],
        'shop' => [
            'title' => 'Shop',
            'submenu' => [
                'category.html' => 'Shop Category',
                'single-product.html' => 'Product Details',
                'checkout.html' => 'Product Checkout',
                'cart.html' => 'Shopping Cart',
                'confirmation.html' => 'Confirmation'
            ]
        ],
        'blog' => [
            'title' => 'Blog',
            'submenu' => [
                'blog.html' => 'Blog',
                'single-blog.html' => 'Blog Details'
            ]
        ],
        'pages' => [
            'title' => 'Pages',
            'submenu' => [
                'login.html' => 'Login',
                'tracking.html' => 'Tracking',
                'elements.html' => 'Elements'
            ]
        ],
        'contact' => [
            'title' => 'Contact',
            'url' => 'contact.html'
        ]
    ];

    private function renderMenuItem(array $item, string $key): void {
        $hasSubmenu = isset($item['submenu']);
        $classes = ['nav-item'];
        if ($hasSubmenu) $classes[] = 'submenu dropdown';
        if ($item['active'] ?? false) $classes[] = 'active';
        
        ?>
        <li class="<?= implode(' ', $classes) ?>">
            <?php if ($hasSubmenu): ?>
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" 
                   aria-haspopup="true" aria-expanded="false"><?= htmlspecialchars($item['title']) ?></a>
                <ul class="dropdown-menu">
                    <?php foreach ($item['submenu'] as $url => $title): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= htmlspecialchars($url) ?>">
                                <?= htmlspecialchars($title) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <a class="nav-link" href="<?= htmlspecialchars($item['url']) ?>">
                    <?= htmlspecialchars($item['title']) ?>
                </a>
            <?php endif; ?>
        </li>
        <?php
    }

    public function render(): void {
        ?>
        <header class="header_area sticky-header">
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light main_box">
                    <div class="container">
                        <a class="navbar-brand logo_h" href="index.html">
                            <img src="img/logo.png" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" 
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav ml-auto">
                                <?php foreach ($this->menuItems as $key => $item): ?>
                                    <?php $this->renderMenuItem($item, $key); ?>
                                <?php endforeach; ?>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="nav-item">
                                    <a href="#" class="cart"><span class="ti-bag"></span></a>
                                </li>
                                <li class="nav-item">
                                    <button class="search">
                                        <span class="lnr lnr-magnifier" id="search"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="search_input" id="search_input_box">
                <div class="container">
                    <form class="d-flex justify-content-between">
                        <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                        <button type="submit" class="btn"></button>
                        <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                    </form>
                </div>
            </div>
        </header>
        <?php
    }
}

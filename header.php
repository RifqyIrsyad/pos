<?php
$menuItems = [
    ['name' => 'Dashboard', 'icon' => 'home', 'link' => 'dashboard.php'],
    ['name' => 'Transaksi', 'icon' => 'fas fa-cart-plus', 'link' => 'transaksi.php'],
    [
        'name' => 'Master Data', 
        'icon' => 'fa fa-plus-circle', 
        'link' => '',
        'submenu' => [
            ['name' => 'Admin', 'link' => 'admin/index.php'],
            ['name' => 'Customer', 'link' => 'customer/index.php'],
            ['name' => 'Category', 'link' => 'categories.php'],
            ['name' => 'Product', 'link' => 'products.php'],
        ]
    ],
    ['name' => 'Laporan', 'icon' => '	fas fa-file-alt', 'link' => 'rekap.php'],
    ['name' => 'Log Out', 'icon' => 'sign-out-alt', 'link' => 'logout.php'],
];

function getIcon($iconName) {
    return "<i class='fas fa-{$iconName}'></i>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nusantara Resto</title>
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff; 
            text-decoration: none;
        }
        .navbar-brand img {
            margin-right: 15px;
            border-radius: 50%; 
        }
        .navbar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        .navbar-menu li {
            margin-left: 25px;
            position: relative;
        }
        .navbar-menu a {
            text-decoration: none;
            color: #ffffff; 
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }
        .navbar-menu a:hover {
            background-color: #3366cc; 
        }
        .navbar-menu a i {
            margin-right: 8px;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        .dropdown-menu a {
            color: #004080;
            padding: 10px 20px;
            white-space: nowrap;
        }
        .navbar-menu li:hover .dropdown-menu {
            display: block;
        }
        .dropdown-menu a:hover {
            background-color: #3366cc;
            color: #ffffff;
        }
        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand">
            <img src="logo.jpg" alt="Logo" width="40" height="40">
            Nusantara Resto
        </a>
        <ul class="navbar-menu">
            <?php foreach ($menuItems as $item): ?>
                <li>
                    <a href="<?php echo $item['link']; ?>">
                        <?php echo getIcon($item['icon']); ?>
                        <?php echo $item['name']; ?>
                    </a>
                    <?php if (isset($item['submenu'])): ?>
                        <ul class="dropdown-menu">
                            <?php foreach ($item['submenu'] as $submenu): ?>
                                <li><a href="<?php echo $submenu['link']; ?>"><?php echo $submenu['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</body>
</html>

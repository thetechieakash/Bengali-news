<?php $uri = uri_string();
$categories = [
    'হোম' => [],
    'মহানগর' => [],
    'লাইফস্টাইল' => [
        'সম্পর্ক',
        'ফ্যাশন',
        'পেট্রোল',
        'টেক',
        'গোয়েন্দাগিরি',
    ],
    'ট্রেন্ডিং' => [],
    'রাজ্য' => [],
    'দেশ' => [],
    'খেলা' => [
        'ক্রিকেট',
        'ফুটবল',
        'অন্যান্য',
    ],
    'সম্পাদকীয়' => [
        'আমাদের কথা',
        'উত্তর সম্পাদকীয়',
    ],
    'সংস্কৃতি' => [],
    'অপরাধ' => [],
    'ধর্মকথা' => [],
    'ওপার বাংলা' => [],
    'বিদেশ' => [],
    'বিনোদন' => [
        'হলি বলি টলি',
        'ভিডিও',
        'সংস্কৃতি',
        'টেলি দুনিয়া',
    ],
    'ছবিঘর' => [],
    'ভিডিও' => [],
    'রাশিফল' => [],
    'বিজ্ঞান ও পরিবেশ' => [],
    'চাকরির খবর' => [],
    'রোববার' => [],
    'ফিচার' => [],
    'বাঁকা কথা' => [],
    'দেশবিদেশ' => [],
    'যোগাযোগ' => [],
    'ইতিহাস' => [],
];

?>
<div class="horizontal-menu">
    <nav class="navbar top-navbar bg-transparent col-lg-12 col-12 p-0 py-3">
        <div class="container position-relative justify-content-center">
            <button
                class="navbar-toggler navbar-toggler-right d-lg-none align-self-centerd-lg-none position-absolute " style="left: 2%;"
                type="button"
                data-toggle="horizontal-menu-toggle-new">
                <span class="ti-menu"></span>
                <span class="ti-close d-none"></span>
            </button>
            <div class="text-start navbar-brand-wrapper d-flex align-items-center justify-content-start me-lg-3">
                <div>
                    <a class="navbar-brand brand-logo" href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/images/logo.jpg" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/images/bangla-logo-mini.svg" alt="logo" />
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation justify-content-start main-top-nav">
                <li class="nav-item <?= $uri == '' ? 'active' : '' ?>">
                    <a class="nav-link " href="<?= base_url() ?>">
                        <!-- <i class="icon-grid menu-icon"></i> -->
                        <span class="menu-title">হোম</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('post') ?>">
                        <span class="menu-title">মহানগর</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#!">
                        <span class="menu-title">রাজ্য</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#!">
                        <span class="menu-title">দেশ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#!">
                        <span class="menu-title">বিদেশ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="menu-title">খেলা</span>
                        <i class="menu-arrow"></i></a>
                    <div class="submenu cs">
                        <ul class="submenu-item">
                            <li class="nav-item">
                                <a class="nav-link" href="#!">ক্রিকেট</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#!">ফুটবল</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#!">অন্যান্য</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#!">
                        <span class="menu-title">বিনোদন</span>
                    </a>
                </li>
                <li class="nav-item mega-menu">
                    <a href="#" class="nav-link">
                        <span class="menu-title">এছাড়াও</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu sub-menu-grid">
                        <div class="sub-menu-grid-layout">
                            <ul>
                                <?php foreach ($categories as $key => $subs) : ?>
                                    <li>
                                        <a class="nav-link" href="#!">
                                            <span class="menu-title"><?= $key ?></span>
                                        </a>
                                    </li>
                                    <?php if (is_array($subs) && count($subs) > 0): ?>
                                        <?php foreach ($subs as $key => $sub) : ?>
                                            <li>
                                                <a class="nav-link" href="#!">
                                                    <span class="menu-title"><?= $sub ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
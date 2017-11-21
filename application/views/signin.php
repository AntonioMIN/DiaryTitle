<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="masthead clearfix">
            <div class="inner">
                <h3 class="masthead-brand">Diary Title</h3>
                <nav>
                    <ul class="nav masthead-nav">
                        <li><a href="/">DIARY</a></li>
                        <li class="active"><a href="/diary/signin">로그인</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="container">
            <?php
            $fb = new Facebook\Facebook([
            'app_id' => '1573725959316440',
            'app_secret' => '82e5551cefbb1ce9f263e7d014507e14',
            'default_graph_version' => 'v2.9',
            ]);
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email','public_profile'];
            $loginUrl = $helper->getLoginUrl('http://diarytitle.dothome.co.kr/auth', $permissions);
            ?>
            <a class="btn btn-primary btn-lg" role="button" href="<?= $loginUrl?>">Facebook으로 로그인하기</a>
        </div>
    </div>
</div>

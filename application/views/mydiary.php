<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="masthead clearfix">
            <div class="inner">
                <h3 class="masthead-brand">Diary Title</h3>
                <nav>
                    <ul class="nav masthead-nav">
                        <li><a href="/">오늘의 이야기</a></li>
                        <li class="active"><a href="/diary/mydiary">나의 이야기</a></li>
                        <li><a href="/diary/signout">로그아웃</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="container">
            <div id="postContainer" class="container">
                <?php
                foreach($posts as $i)
                {
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><?= $i->context?></p>
                    </div>
                    <div class="panel-footer">
                        <p><?= $i->name?></p>
                        <p class="writendatetime"><?= $i->created_at?></p>
                        <p class="likecount">
                            <?=$i->like_count?>
                            <button type="button" onclick="like(<?= $i->id?>)" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> 공감
                            </button>
                            <button type="button" onclick="deletePost(<?= $i->id?>)" class="btn btn-danger btn-sm">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 삭제
                            </button>
                        </p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
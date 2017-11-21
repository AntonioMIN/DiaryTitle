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
                        <li class="active"><a href="/">오늘의 이야기</a></li>
                        <li><a href="/diary/mydiary">나의 이야기</a></li>
                        <li><a href="/diary/signout">로그아웃</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="container site-context">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-default writebutton" data-toggle="modal" data-target="#myModal">오늘 남기기</button>
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
                        </p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body" onclick="getPosts();">
                        <h5 class="text-center">더보기</h5>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">오늘 남기기</h4>
                    </div>
                        <div class="modal-body">
                            <div id="summernote"></div>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    <button type="button" onclick="writeToday();" class="btn btn-default">남기기</button>
                    </div>
                </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']]
        ]
        });
        $('#summernote').summernote('fontName', 'Noto Sans KR');
    });
</script>
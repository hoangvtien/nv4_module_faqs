<!-- BEGIN: main -->
<style type="text/css">
.block_video_new {
	border:1px solid #F4F4F4;
	padding:5px;
	background:#F9F9F9;
	height:255px;
	position:relative
}
.block_video_new p{
	margin:0;
}
.view { color:#666; font-size:11px }
.show { color:#F60; font-size:11px; font-weight:bold }
</style>
<div class="block_video_new">
    <strong><a href="{ROW.link}" title="{ROW.title}">{ROW.title1}</a></strong>
    <span class="view">{LANG.view}</span>: <strong class="show">{ROW.viewer}</strong> |
    <span class="view">{LANG.update}</span>: <strong class="show">{ROW.addtime}</strong>
    <p><strong class="comment_question">{LANG.faq_question}</strong> : {ROW.question}</p>
</div>
<!-- END: main -->
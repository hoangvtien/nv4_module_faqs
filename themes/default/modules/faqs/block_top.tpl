<!-- BEGIN: main -->

<style type="text/css">
.hethong {
    background: none repeat scroll 0 0 #F7FBFB;
    line-height:32px;
    font-weight: bold;
    color: #FF6600;
    text-transform:uppercase;
    text-align: center;
    font-size: 15px;
}
.faqs_content li{
	margin-bottom:10px;
	border-bottom:1px dotted #CCC;
	padding-bottom:5px;
	font-size:12px;
	color:#006699;
}
.answer {
	display:inline-block;
	padding-left:18px; background:url({NV_BASE_SITEURL}themes/{THEME}/images/faq/answer.png) no-repeat;
	font-size:11px;
}
.comment_answer{
	background:url({NV_BASE_SITEURL}themes/{THEME}/images/faq/answer1.png) no-repeat center left; padding-left: 18px;
	font-size:14px;
	color:#00868B;

}
.send_question {
	line-height:25px;
	display:inline-block;
	float:right;
	padding:5px 2px;
}
.send_question span{
	background:url({NV_BASE_SITEURL}themes/{THEME}/images/faq/question.png) no-repeat center left; padding-left: 18px;
}
.comment_question{
	background:url({NV_BASE_SITEURL}themes/{THEME}/images/faq/comment_question.png) no-repeat center left; padding-left: 18px;
	font-size:14px;
	color:#F00;

}
.view { color:#666; font-size:11px }
.show { color:#F60; font-size:11px; font-weight:nomal }
</style>
<div class="hethong">hệ thống tư vấn hỏi-đáp</div>
<ul class="faqs_content">
<!-- BEGIN: loop -->
<li>
    <h2><a href="{ROW.link}" title="{ROW.title}">{ROW.title}</a></h2>
    <span class="view">{LANG.view}</span>: <strong class="show">{ROW.viewer}</strong> |
    <span class="view">{LANG.update}</span>: <strong class="show">{ROW.addtime}</strong>
    <p><strong class="comment_question">{LANG.faq_question}</strong> : {ROW.question}</p>
    <class="faqs_content1">
    <p><strong class="comment_answer">{LANG.faq_answer}</strong> : {ROW.answer}</p>
    <h2><a href="{ADDQ}" class="send_question"><span>{LANG.send_question}</span></a></h2><hr>
</li>
<!-- END: loop -->
</ul>
<!-- END: main -->
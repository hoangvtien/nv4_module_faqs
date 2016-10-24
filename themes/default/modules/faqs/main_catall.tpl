<!-- BEGIN: main -->
<div class="tieude"><font color="#FF0000">hệ thống tư vấn hỏi-đáp</font></div>
<!-- BEGIN: cat -->
<div class="faqs_content_cate">
	<strong><a href="{CATE.link}">{CATE.title}</a></strong>
    <!-- BEGIN: subcat -->
    <span><a href="{SUB.link}">{SUB.title}</a></span>
    <!-- END: subcat -->
</div>
<ul class="faqs_content">
	<!-- BEGIN: loop -->
    <li>
    	<h2><a href="{ROW.link}" title="{ROW.title}">{ROW.title}</a></h2>
        <span class="view">{LANG.view}</span>: <strong class="show">{ROW.view}</strong> |
        <span class="view">{LANG.update}</span>: <strong class="show">{ROW.addtime}</strong>
        <p><strong class="comment_question">{LANG.question}</strong> : {ROW.question}</p>
        <p align="right"><a href="{ROW.link}" title="{ROW.title}" class="answer">{LANG.answer}</a></p>
    </li>
    <!-- END: loop -->
</ul>
<!-- END: cat -->
<!-- END: main -->
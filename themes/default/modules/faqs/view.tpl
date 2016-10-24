<!-- BEGIN: main -->
<div class="faqs_content_cate">
	<h3 style="margin:4px 0px; font-size:16px;">{DATA.title}</h3>
</div>
<div class="faqs_content">
    <p><strong class="comment_question">{LANG.question}</strong> : <span style="font-style:italic">{DATA.question}</span></p>
    <br />
    <p><strong>{LANG.answer1}</strong> : {DATA.answer}</p>
    <span class="view">{LANG.view}</span>: <strong class="show">{DATA.viewer}</strong> | 
    <span class="view">{LANG.update}</span>: <strong class="show">{DATA.addtime}</strong> |
    <span class="view">{LANG.cat_title}</span>: <strong class="show"><a href="{cat_link}">{cat_title}</a></strong>
</div>
<ul class="faqs_content" style="margin-top:10px">
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
<!-- END: main -->
<!-- BEGIN: main -->
<form action="" class="faqs_content_cate clearfix" method="post" onsubmit="return search_submit_form()">
	<center>{LANG.search}: </option><input type="text" style="width:200px;" value="{q}" name="q" id="faq_q"/>
    <select name="catid" id="faq_catid">
    	<option value="0">{LANG.all}</option>
        <!-- BEGIN: loop -->
        <option value="{ROW.catid}" {ROW.select}>{ROW.title}</option>
        <!-- END: loop -->
    </select>
    <input type="button" value="{LANG.search}" onClick="search_submit_form()"/></center>
   <!-- <a href="{question}" class="send_question"><span>{LANG.send_question}</span></a> --->
</form>
<!-- END: main -->

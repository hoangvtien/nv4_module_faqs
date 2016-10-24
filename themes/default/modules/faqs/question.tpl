<!-- BEGIN: main -->
<div class="faqs_content_cate">
	<strong class="comment_question">{LANG.send_question}</strong>
</div>
<!-- BEGIN: error -->
<div class="faqs_content_cate">
	<strong style="color: #F00">{error}</strong>
</div>
<!-- END: error -->
<form action="" method="post" class="faqs_content_cate">
<input type="hidden" name="save" value="1"/>
	<table cellpadding="1" cellspacing="1" width="100%">
    <tr>
    	<td width="60">{LANG.name}</td>
        <td><input type="text" style="width:180px" name="name" value="{DATA.name}" readonly></td>
    </tr>
    	<td>{LANG.email}</td>
        <td>
        	<input type="text" style="width:180px" name="email" value="{DATA.email}" readonly>
			<select name="catid">
                <!-- BEGIN: loop -->
                <option value="{ROW.id}" {ROW.select}>{ROW.title}</option>
                <!-- END: loop -->
            </select>
        </td>
    </tr>
    <tr>
    	<td>{LANG.title_faq}</td>
        <td>
        	<input type="text" style="width:98%" name="title" value="{DATA.title}">	
        </td>
    </tr>
    <tr>
    	<td valign="top">{LANG.question_faq}</td>
        <td>
        	<textarea style="width:98%; height:80px; font-family:Arial; font-size:12px" name="question">{DATA.question}</textarea>
        </td>
    </tr>
    <tr>
    	<td></td>
        <td>
        	<input type="text" maxlength="6" id="fcode_iavim" name="fcode" class="fl" />
            <img class="fl" src="{NV_BASE_SITEURL}index.php?scaptcha=captcha" title="{LANG.captcha}" id="vimg" 
            onclick="nv_change_captcha('vimg','fcode_iavim');" style="height:21px; cursor:pointer"/>
            <input type="submit" value="{LANG.send_question}" class="fr"/>
        </td>
    </tr>
    </table>
</form>
<!-- END: main -->
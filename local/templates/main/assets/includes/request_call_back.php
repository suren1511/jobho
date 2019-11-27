<div id="comp_bf702a7b0bc348dc4cf0567c2be07fa0">
    <div id="popup1" class="popup">


        <form name="request_call_back" action="/includes/request_call_back.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="bxajaxid" id="bxajaxid_bf702a7b0bc348dc4cf0567c2be07fa0_8BACKi" value="bf702a7b0bc348dc4cf0567c2be07fa0"/><input type="hidden" name="AJAX_CALL" value="Y"/>
            <script type="text/javascript">
                function _processform_8BACKi() {
                    if (BX('bxajaxid_bf702a7b0bc348dc4cf0567c2be07fa0_8BACKi')) {
                        var obForm = BX('bxajaxid_bf702a7b0bc348dc4cf0567c2be07fa0_8BACKi').form;
                        BX.bind(obForm, 'submit', function () {
                            BX.ajax.submitComponentForm(this, 'comp_bf702a7b0bc348dc4cf0567c2be07fa0', true)
                        });
                    }
                    BX.removeCustomEvent('onAjaxSuccess', _processform_8BACKi);
                }

                if (BX('bxajaxid_bf702a7b0bc348dc4cf0567c2be07fa0_8BACKi'))
                    _processform_8BACKi();
                else
                    BX.addCustomEvent('onAjaxSuccess', _processform_8BACKi);
            </script>
            <input type="hidden" name="sessid" id="sessid" value="871dd5eb56b46abd4fe90b5b313a7b4a"/><input type="hidden" name="WEB_FORM_ID" value="7"/>


            <div class="popup__input">

                <input type="text" placeholder="Ф.И.О." class="inputtext" name="form_text_59" value="" size="60"/></div>


            <div class="popup__input">

                <input type="text" placeholder="+7 (___) ___-__-__" class="inputtext inputphone" id="phonenumber" name="form_text_60" value="" size="0"/>
            </div>


            <div class="popup__input">

                <input type="text" placeholder="Время звонка" class="inputtext" name="form_text_61" value="" size="0" onclick="BX.calendar({node: this, field: this, bTime: true});">
            </div>
            <input type="hidden" name="form_hidden_62" value="url_call"/>
            <div class="popup__agreement">
                <label>Нажимая кнопку "Жду звонка" вы принимаете <a href="/politics.php" class="police_check">условия
                        пользовательского соглашения</a></label>
            </div>
            <input type="submit" name="web_form_submit" value="Жду звонка" class="popup__submit btn btn--red"/>

        </form>
    </div>
</div>
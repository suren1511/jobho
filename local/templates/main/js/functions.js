var wnd, isIE = navigator.userAgent.indexOf("MSIE") >= 0 && navigator.userAgent.indexOf("Opera") < 0,
    icoockies;

function ResetForm() {
    var e, t = document.FindForm;
    for (t.reset(), t.district && (t.district.value = ""), t.city && (t.city.value = ""), i = 0; i < t.elements.length; i++) "checkbox" == (e = t.elements(i).type) && (t.elements(i).checked = !1), "text" == e && (t.elements(i).value = ""), "select-one" == e && (t.elements(i).selectedIndex = 0)
}

function makeCall(e) {
    return window.open("http://www.sitephone.ru/sp.htm?" + e, "callWindow", "height=160,width=340,status=no,toolbar=no,menubar=no,location=no").focus(), !1
}

function showImage(e) {
    wnd && !wnd.closed && wnd.close(), wnd = window.open("/common/photo.aspx?id=" + e, null, "resizable=yes,status=no,width=400,height=300")
}

function showImageObject(e) {
    wnd && !wnd.closed && wnd.close(), wnd = window.open("/common/photoObject.aspx?id=" + e, null, "resizable=yes,status=no,width=400,height=300")
}

function showImageBranch(e) {
    wnd && !wnd.closed && wnd.close(), wnd = window.open("/common/photoBranch.aspx?id=" + e, null, "resizable=yes,status=no,width=400,height=300")
}

function showImageOffer(e) {
    wnd && !wnd.closed && wnd.close(), wnd = window.open("/common/photoOffer.aspx?id=" + e, null, "resizable=yes,status=no,width=400,height=300")
}

function changeImages() {
    if (document.images)
        for (var e = 0; e < changeImages.arguments.length; e += 2) document[changeImages.arguments[e]].src = changeImages.arguments[e + 1]
}

function showContentImage(e, t) {
    wnd && !wnd.closed && wnd.close(), wnd = window.open("/common/photoContent.aspx?id=" + e + "&imageUrl=" + t, null, "resizable=yes,status=no,width=400,height=300")
}

function showAdvanced(v) {
    with(document.getElementById("advanced").style)
    "none" == display ? (document.Form1.advanced.value = 0, display = "", v.innerHTML = '<img border="0" src="/i/vnutr-menu-13a.gif" width="28" height="22">') : (document.Form1.advanced.value = 1, display = "none", v.innerHTML = '<img border="0" src="/i/vnutr-menu-13.gif" width="28" height="22">')
}

function checkRequest(e) {
    return "" == e.Name.value ? (e.Name.focus(), alert("Введите Ваше имя"), !1) : "" == e.Contacts.value ? (e.Contacts.focus(), alert("Введите координаты для связи"), !1) : "" == e.Text.value ? (e.Text.focus(), alert("Введите текст"), !1) : !(e.Text.value.length > 1400) || (e.Text.focus(), alert("Текст слишком длинный"), !1)
}

function checkRentRequest(e) {
    if (e.captcha && "" == e.captcha.value) return alert("Введите цифры, которые вы видите на картинке в соответствующее поле"), e.captcha.focus(), !1;
    if ("" == e.Name.value) return e.Name.focus(), alert("Введите Ваше имя"), !1;
    if (e.Contacts.value.length + e.Email.value.length == 0) {
        if (alert("Введите свою контактную информацию"), "" == e.Contacts.value) return e.Contacts.focus(), !1;
        if ("" == e.Email.value) return e.Email.focus(), !1
    }
    return "" == e.Text.value ? (e.Text.focus(), alert("Введите текст заявки"), !1) : !(e.Text.value.length > 1400) || (e.Text.focus(), alert("Текст слишком длинный"), !1)
}

function checkRentRequestPerday(e) {
    if ("" == e.Name.value) return e.Name.focus(), alert("Введите Ваше имя"), !1;
    if (e.Contacts.value.length + e.Email.value.length == 0) {
        if (alert("Введите свою контактную информацию"), "" == e.Contacts.value) return e.Contacts.focus(), !1;
        if ("" == e.Email.value) return e.Email.focus(), !1
    }
    if ("" == e.Text.value) return e.Text.focus(), alert("Введите текст заявки"), !1;
    if (e.Text.value.length > 1400) return e.Text.focus(), alert("Текст слишком длинный"), !1;
    if (flats_perday) {
        if ("" == e.invasion_date.value) return e.invasion_date.focus(), alert("Укажите дату заезда"), !1;
        if ("" == e.getout_date.value) return e.getout_date.focus(), alert("Укажите дату выезда"), !1
    }
    return !0
}

function checkQuestion(e) {
    return "" == e.Name.value ? (e.Name.focus(), alert("Введите Ваше имя"), !1) : "" == e.Contacts.value ? (e.Contacts.focus(), alert("Введите координаты для связи"), !1) : "" == e.Email.value ? (e.Email.focus(), alert("Введите email"), !1) : "" == e.Text.value ? (e.Text.focus(), alert("Введите текст вопроса"), !1) : !(e.Text.value.length > 1400) || (e.Text.focus(), alert("Текст слишком длинный"), !1)
}

function checkTrimComment(e) {
    return String.prototype.trim = function() {
        return this.replace(/^\s+|\s+$/g, "")
    }, "" == e.type.value.trim() ? (alert("Укажите тип отзыва"), !1) : "" == e.marketoperationtype.value.trim() ? (alert("Укажите вид деятельности"), !1) : e.division0_0.value.trim().length + e.division0_1.value.trim().length + e.division2_0.value.trim().length + e.division2_1.value.trim().length + e.division4_0.value.trim().length + e.division4_1.value.trim().length + e.division3_1.value.trim().length == 0 ? (alert("Укажите отделение"), !1) : "" + e.Name.value.trim() == "" ? (e.Name.focus(), alert("Введите Ваше имя"), !1) : "" + e.Contacts.value.trim() == "" ? (e.Contacts.focus(), alert("Введите телефон"), !1) : "" + e.Email.value.trim() == "" ? (e.Email.focus(), alert("Введите email"), !1) : "" + e.Text.value.trim() == "" ? (e.Text.focus(), alert("Введите текст вопроса"), !1) : !(e.Text.value.length > 1400) || (e.Text.focus(), alert("Текст слишком длинный"), !1)
}

function checkOffer(e) {
    return "" != e.Text.value && " " != e.Text.value || (e.Text.focus(), alert("Введите текст предложения"), !1)
}

function setPlan(e) {
    var t = document.getElementById("id_plan");
    s = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="237" height="244" id="lupa" align="middle">\n<param name="allowScriptAccess" value="sameDomain" />\n<param name="link_flash" value="/image/' + e + '.swf">\n<param name="movie" value="lupa.swf?link_flash=/image/' + e + ".swf&link_url=javascript:showPlan(" + e + ');">\n<param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />\n<embed src="dfglupa.swf" quality="high" bgcolor="#ffffff" width="237" height="244" name="lupa" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\n</object>', t.innerHTML = s
}

function setPlanOld(e) {
    var t = document.getElementById("id_plan");
    s = '<OBJECT align="right" height="250" width="220" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,0,0" VIEWASTEXT>\n<param name="menu" value="true">\n<PARAM name="movie" value="/image/' + e + '.swf">\n<PARAM name="quality" value="high">\n<PARAM name="bgcolor" value="#ffffff">\n<EMBED height="250" width="220" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"  bgcolor="#ffffff" quality="high" src="/image/' + e + '.swf"></EMBED>\n</OBJECT>', t.innerHTML = s, (t = document.getElementById("a_plan")).href = "/image/" + e + ".swf", t.onclick = new Function("showPlan(" + e + "); return false;")
}

function showPlan(e) {
    window.open("/common/" + e + ".html", "", "scrollbars=0,menubar=1,resizable=1,width=492,height=510")
}

function onMoscowChecked(e) {
    var t = document.Form1;
    t.cbM.checked || t.cbR.checked || (t.cbR.checked = !0), e && (t.cbM.checked || removeAll(), t.cbR.checked || DremoveAll(), onShowStation(t.cbM.checked), onShowHighway(t.cbR.checked))
}

function onRegionChecked(e) {
    var t = document.Form1;
    t.cbM.checked || t.cbR.checked || (t.cbM.checked = !0), e && (t.cbM.checked || removeAll(), t.cbR.checked || DremoveAll(), onShowStation(t.cbM.checked), onShowHighway(t.cbR.checked))
}

function check_region_moscow_checkboxes() {
    var e = document.Form1;
    e.cbM.checked = !0, e.cbR.checked = !0, onShowHighway(e.cbR.checked), onShowStation(e.cbM.checked)
}

function onShowStation(e) {
    var t = "",
        n = 81;
    e ? (t = "block", n = 81) : (t = "none", n = 177), document.getElementById("cStations").style.display = t, document.getElementById("cStationsSel").style.display = t, document.getElementById("selectedStations").style.display = t, document.getElementById("lineStations").style.display = t, document.getElementById("invis").style.display = t, document.getElementById("Directions").style.height = n, document.getElementById("selectedDirection").style.height = n
}

function onShowHighway(e) {
    var t = "",
        n = 81;
    e ? (t = "block", n = 81) : (t = "none", n = 177), document.getElementById("cDirections").style.display = t, document.getElementById("Directions").style.display = t, document.getElementById("cselectedDirection").style.display = t, document.getElementById("selectedDirection").style.display = t, document.getElementById("lineStations").style.height = n, document.getElementById("selectedStations").style.height = n
}

function Open_SendToFriend(e) {
    wnd && !wnd.closed && wnd.close(), wnd = window.open("/common/send_to_friend.aspx?url=" + escape(e), null, "resizable=yes,status=no,width=500,height=554")
}

function integration(e) {
    "none" == document.getElementById(e).style.display ? (document.getElementById(e).style.display = "block", changeImages("arrow", "/img/tr_white_up5.gif")) : (document.getElementById(e).style.display = "none", changeImages("arrow", "/img/tr_white_down5.gif"))
}

function checkTrimQuestion(e) {
    return String.prototype.trim = function() {
        return this.replace(/^\s+|\s+$/g, "")
    }, "" == e.Name.value.trim() ? (e.Name.focus(), alert("Введите Ваше имя"), !1) : "" == e.Contacts.value.trim() ? (e.Contacts.focus(), alert("Введите координаты для связи"), !1) : "" == e.Email.value.trim() ? (e.Email.focus(), alert("Введите email"), !1) : "" == e.Text.value.trim() ? (e.Text.focus(), alert("Введите текст вопроса"), !1) : !(e.Text.value.length > 1400) || (e.Text.focus(), alert("Текст слишком длинный"), !1)
}

function clearform(formname) {
    var a = eval(formname);
    for (i = 0; i < a.elements.length; i++) "text" == a.elements[i].type || ("radio" == a.elements[i].type && -1 == a.elements[i].value.indexOf("special") ? (alert(a.elements[i].value), a.elements[i].checked = !1) : "checkbox" == a.elements[i].type ? a.elements[i].checked = !1 : "textarea" == a.elements[i].type ? a.elements[i].value = "" : "select-one" == a.elements[i].type ? a.elements[i].value = "" : "select-multiple" == a.elements[i].type && (a.elements[i].value = ""));
    document.forms.SearchForm.m.value = "", document.forms.SearchForm.d.value = ""
}

function notebook(e, t) {
    var n = new Date;
    getCookie(e + "_" + t) ? (null != icoockies && icoockies > 0 && (icoockies -= 1), n.setTime(n.getTime() - 1296e6), setCookie(e + "_" + t, 0, n.toGMTString()), document.getElementById("i" + t).src = "/img/notebook_off.gif", document.getElementById("b" + t).title = "Добавить в блокнот") : (null != icoockies && icoockies >= 0 && (icoockies += 1), n.setTime(n.getTime() + 1296e6), setCookie(e + "_" + t, 1, n.toGMTString()), document.getElementById("i" + t).src = "/img/notebook_on.gif", document.getElementById("b" + t).title = "Удалить из блокнота"), null != icoockies && icoockies >= 0 && (document.getElementById("coockiecount").innerHTML = 0 == icoockies ? "" : "(" + icoockies + ")")
}

function getCookie(e, t) {
    var n = " " + document.cookie,
        o = " " + e + "=",
        l = null,
        a = 0,
        c = 0;
    return n.length > 0 && -1 != (a = n.indexOf(o)) && (a += o.length, -1 == (c = n.indexOf(";", a)) && (c = n.length), l = unescape(n.substring(a, c))), l
}

function setCookie(e, t, n, o, l) {
    path = "/", document.cookie = e + "=" + t + (n ? "; expires=" + n : "") + (path ? "; path=" + path : "") + (o ? "; domain=" + o : "") + (l ? "; secure" : "")
}
var max_link_dotted = 25;

function showlayer(e) {
    for (var t = 1; t < max_link_dotted; t++) e == t && t++, document.getElementById("layer" + t) && (document.getElementById("layer" + t).style.display = "none");
    document.getElementById("layer" + e) && ("block" == document.getElementById("layer" + e).style.display ? document.getElementById("layer" + e).style.display = "none" : document.getElementById("layer" + e).style.display = "block")
}

function wopen(e, t, n) {
    t || (t = 800), n || (n = 800), window.open(e, "", "width=" + t + ", height=" + n + ",resizable,scrollbars,status")
}

function wopencontent(e) {
    window.open(e, "", "width=1040, height=830,resizable,scrollbars,status")
}

function wopenfree(e) {
    window.open(e, "", "")
}

function fill_reqfrm(e, t, n) {
    document.getElementById("goodres").style.display = "none", document.getElementById("fQuestion").style.display = "block", document.getElementById("msg_status_info").innerHTML = "", document.getElementById("reqobject_id").value = e || "", t ? (document.getElementById("reqlotnumber").value = t, document.getElementById("reqlotnumbertext") && (document.getElementById("reqlotnumbertext").innerHTML = 'Номер лота: "' + t + '"')) : (document.getElementById("reqlotnumber").value = "", document.getElementById("reqlotnumbertext") && (document.getElementById("reqlotnumbertext").innerHTML = "")), document.getElementById("reqbranch_id").value = n || ""
}

function MakeImageMap() {
    if (document.getElementById("map1")) {
        var e, t = document.getElementById("map1");
        for (x = 0; x < Sts.length; x++)(e = document.createElement("div")).id = "s" + Sts[x].id, e.style.width = "10px", e.style.position = "absolute", e.style.left = Sts[x].x + "px", e.style.top = Sts[x].y + "px", e.innerHTML = '<img id="imm' + x + '" alt="' + Sts[x].name + '" src="/img/obana4.gif" onclick="JavaScript:mSel(' + x + ');" style="cursor:hand;cursor:pointer">', t.appendChild(e);
        for (var n = 0; n < SelSts.length; n++)
            for (var o = 0; o < Sts.length; o++) SelSts[n] == Sts[o].id && addToSel(o)
    }
}

function switchFormTabNew(e) {
    var t = document.getElementById("frmtab1"),
        n = document.getElementById("frmtab2"),
        o = document.getElementById("conttab1"),
        l = document.getElementById("conttab2"),
        a = document.getElementById("locality"),
        c = (document.getElementById("selectedStations"), document.getElementById("selectedDirection"), document.getElementById("single-room")),
        i = document.getElementById("time_to_metro"),
        s = document.getElementById("isMoscowInput");
    0 == e ? (o.style.display = "none", l.style.display = "block", a && (a.style.display = "inline"), s.value = "0", n.className = "active", t.className = "inactive", c && (c.style.display = "none"), i && (i.style.display = "none")) : (l.style.display = "none", o.style.display = "block", a && (a.style.display = "none"), s.value = "1", n.className = "inactive", t.className = "active", c && (c.style.display = ""), i && (i.style.display = ""))
}

function switchFormTab(e) {
    var t, n = document.getElementById("frmtab1"),
        o = document.getElementById("frmtab2"),
        l = document.getElementById("conttab1"),
        a = document.getElementById("conttab2"),
        c = (document.getElementById("selectedStations"), document.getElementById("selectedDirection"), document.getElementById("isMoscowInput"));
    t = n.innerHTML, n.innerHTML = o.innerHTML, o.innerHTML = t, 0 == e ? (o.href = "javascript:switchFormTab(1);", l.style.display = "none", a.style.display = "block", c.value = "0") : (o.href = "javascript:switchFormTab(0);", a.style.display = "none", l.style.display = "block", c.value = "1")
}

function select_directions(e) {
    searchForm = "SearchForm";
    for (var t = 0; t < e.length; t++) select_dir(e[t])
}

function select_dir(e) {
    searchForm = "SearchForm";
    var t = document.getElementById("selectedDirection");
    if (document.getElementById("zel" + e)) {
        var n = document.getElementById("zel" + e);
        document.getElementById("d" + e) && (document.getElementById("d" + e).checked = !1), t.removeChild(n), dcount--, Dts[e].checked = !1, 0 == dcount && (document.getElementById("selectedDirection").innerHTML = DemptyText)
    } else s = '<div id = "zel' + e + '" ' + divStyle + ">", s += '<input id = "ztS_' + e + '" ' + inputStyle + ' type="hidden" checked name="d[]" value="' + Dts[e].name + '">', s += "<label for = ztS_" + e + " " + labelStyle + ">" + Dts[e].name + '<img src="/img/close.png" style="cursor:hand;cursor:pointer"  onclick="select_dir(' + e + '); return false" type="checkbox" checked name="d[]" value=""></label>', s += "</div>", t.innerHTML += s, document.getElementById("d" + e) && (document.getElementById("d" + e).checked = !0), dcount++, Dts[e].checked = !0;
    console.log(dcount)
}

function DremoveAll_new() {
    for (e = 1; e <= 50; e++) null != document.getElementById("d" + e) && (document.getElementById("d" + e).checked = !1);
    for (var e in Dts.length) Dts[e].checked && select_dir(Dts[e]);
    dcount = 0, document.getElementById("selectedDirection").innerHTML = DemptyText
}
function updateSel() {
    if (IE) {
        var e = document.getElementById("selectedStations"),
            t = e.innerHTML;
        e.innerHTML = t
    }
}

function loadLine(e) {
    var t = document.getElementById("lineStations");
    s = "";
    for (var n = 0; n < Sts.length; n++) s += '<div style="margin-top: -3px; margin-bottom: -3px;">', s += '<input id = "st_' + Sts[n].id + '" onclick = "if (checked) addToSel(' + n + "); else removeSel(" + n + ')" type = checkbox style = "width: 10px; vertical-align: middle; margin-right: 5px;" ' + (Sts[n].checked ? "checked" : "") + " value = " + Sts[n].id + ">", s += "<label for = st_" + Sts[n].id + ">" + Sts[n].name + "</label>", s += "</div>";
    t.innerHTML = s
}

function mSel(e) {
    Sts[e].checked ? (Sts[e].locked = 0, removeSel(e), document.getElementById("imm" + e).src = "/local/templates/main/img/obana4.gif") : (addToSel(e), incLock(e))
}

function loadStByLine() {
    stByLine[8] = [58, 15, 90, 111, 118, 55, 67, 175, 72, 142, 99, 41, 93, 100, 51, 12, 78, 43, 129], 
	stByLine[20] = [74, 213, 111, 214, 215, 23, 71, 32, 106, 53, 44, 61, 123, 175,152,137,43,73], 
	stByLine[21] = [162, 171, 115, 134, 59, 55], 
	stByLine[22] = [121, 29, 30, 133, 9, 39, 15], 
	stByLine[24] = [107, 166, 11, 167, 68, 139, 36, 77, 51, 66,131, 7], 
	stByLine[26] = [76, 10, 126, 21, 27, 4, 122, 118], 
	stByLine[27] = [108, 141, 155, 179, 94, 112, 14, 159, 58, 12], 
	stByLine[28] = [87, 86, 104, 177, 0, 109, 72], 
	stByLine[29] = [5, 17, 97, 28, 105, 150, 40, 125, 90, 78], 
	stByLine[30] = [74, 213, 214, 215, 23, 71, 32, 106, 53, 44, 61, 123, 175,152,137,43,73], 
	stByLine[31] = [117, 216, 217, 218, 219, 165, 34, 136, 168, 100], 
	stByLine[32] = [1, 54, 212, 50, 48, 169, 96, 42, 57, 99], 
	stByLine[36] = [91, 183, 147, 56, 16, 47, 92, 119, 2, 69, 176, 93], 
	stByLine[37] = [116, 210, 211, 31, 145, 65, 124, 38, 45, 142], 
	stByLine[39] = [153, 82, 83, 84, 127, 172, 182, 114, 160, 6, 22, 41, 129], 
	stByLine[231] = [79, 33, 220, 138, 63, 80, 66, 130, 101, 51, 81], 
	stByLine[232] = [178, 103, 46, 102, 128, 180, 13, 67]
}

function stToHtmlFirstPart(e) {
    var t = "";
    for (i = 0; i < e.length; i++) t = "", t += "<div " + divStyle + ">", t += '<input id="clear" ' + inputStyle + ' style="cursor:hand;cursor:pointer" onclick = "removeAll(); return false" type = checkbox>', t += "<label for = clear " + labelStyle + "><i>&nbsp;Очистить список</i></label>", t += "</div>";
    return t
}
 
function stToHtmlSecondPart(e) {
    var t = "";
    for (i = 0; i < e.length; i++) {
        var n = document.getElementById("sel" + e[i]);
        if (null == n || void 0 == n) {
            var l = "";
            l = Sts[e[i]].lineid > 0 ? '<img src="/local/templates/main/img/subway' + Sts[e[i]].lineid + '.gif" style="cursor:hand;cursor:pointer" onclick="javascript:DopCheck(' + e[i] + ')">' : '<img src="/local/templates/main/img/spacer.gif">', t += '<div id = "sel' + e[i] + '" ' + divStyle + ">", t += '<input id = "stS_' + e[i] + '" ' + inputStyle + ' style="cursor:hand;cursor:pointer" onclick="removeSel(' + e[i] + '); return false" type="checkbox" checked name="m[]" value="' + Sts[e[i]].id + '">&nbsp;', t += "<label for = stS_" + e[i] + " " + labelStyle + ' style="cursor:hand;cursor:pointer" >' + l + "&nbsp;" + Sts[e[i]].name + "</label>", t += "</div>"
        }
    }
    return t
}

function lSel(e) {
    for (1 == lines[e] ? lines[e] = 0 : lines[e] = 1, i = 0; i < stByLine[e].length; i++) addToSel(stByLine[e][i]), 1 != lines[e] ? (decLock(stByLine[e][i]), 0 == showLock(stByLine[e][i]) && removeSel(stByLine[e][i])) : incLock(stByLine[e][i])
}

function incLock(e) {
    return void 0 == Sts[e].locked ? Sts[e].locked = 1 : Sts[e].locked = Sts[e].locked + 1
}

function decLock(e) {
    return void 0 == Sts[e].locked || Sts[e].locked <= 0 ? Sts[e].locked = 0 : Sts[e].locked = Sts[e].locked - 1
}

function showLock(e) {
    return Sts[e].locked
}

function lSelCenter(e) {
    var t, n, l;
    for (void 0 == e ? (t = "center", n = centerStation) : (t = "extCenter", n = centerStationExt), l = document.getElementById("selectedStations"), 1 == lines[t] ? lines[t] = 0 : (lines[t] = 1, 0 == count && (l.innerHTML = stToHtmlFirstPart(n)), l.innerHTML += stToHtmlSecondPart(n)), i = 0; i < n.length; i++) {
        var s = n[i],
            c = document.getElementById("sel" + s),
            o = document.getElementById("st_" + Sts[s].id);
        o && (o.checked = !0), Sts[s].checked = !0;
        var d = document.getElementById("imm" + s);
        null != d && (d.src = "/local/templates/main/img/obana5.gif"), count++, 1 != lines[t] ? (decLock(s), 0 == showLock(s) && (void 0 != c && null != c && l.removeChild(c), o && (o.checked = !1), 0 == --count && (document.getElementById("selectedStations").innerHTML = emptyText), Sts[s].checked = !1, d.src = "/local/templates/main/img/obana4.gif")) : incLock(s)
    }
}

function DopCheck(e) {
    Sts[e].checked ? removeSel(e) : addToSel(e)
}

function loadAll() {
    document.body.style.cursor = "wait";
    var e = document.getElementById("lineStations");
    e.innerHTML = "";
    for (var t = "", n = "", i = 0; i < Sts.length; i++) n = Sts[i].lineid > 0 ? '<img src="/local/templates/main/img/subway' + Sts[i].lineid + '.gif" style="cursor:hand;cursor:pointer" onclick="javascript:DopCheck(' + i + ')">' : '<img src="/local/templates/main/img/spacer.gif">', t += "<div " + divStyle + ">", t += '<input id = "st_' + Sts[i].id + '" style="cursor:hand;cursor:pointer" onclick = "if (checked) addToSel(' + i + "); else removeSel(" + i + ')" type="checkbox" ' + inputStyle + " " + (Sts[i].checked ? "checked" : "") + ' value="' + Sts[i].id + '">&nbsp;', t += "<label for = st_" + Sts[i].id + " " + labelStyle + ' style="cursor:hand;cursor:pointer" >' + n + "&nbsp;" + Sts[i].name + "</label>", t += "</div>";
    e.innerHTML = t, document.body.style.cursor = "default"
}

function InitloadAll() {
    loadAll();
    for (var e = "", t = 0; t < Sts.length; t++) e = e + '<div id="s' + Sts[t].id + '" style="position:absolute; left:' + Sts[t].x + "; top:" + Sts[t].y + ';"><img id="imm' + t + '" alt="' + Sts[t].name + '" src="/local/templates/main/img/obana4.gif" onclick="JavaScript:mSel(' + t + ');" style="cursor:hand;cursor:pointer"></div>';
    for (var t = 0; t < SelSts.length; t++)
        for (var n = 0; n < Sts.length; n++) SelSts[t] == Sts[n].id && addToSel(n);
    0 == count && (document.getElementById("selectedStations").innerHTML = emptyText)
}

function addToSel(e) {
    var t = document.getElementById("selectedStations");
    0 == count && (s = "<div " + divStyle + ">", s += '<input id="clear" ' + inputStyle + ' style="cursor:hand;cursor:pointer" onclick = "removeAll(); return false" type = checkbox>', s += "<label for = clear " + labelStyle + "><i>&nbsp;очистить список</i></label>", s += "</div>", t.innerHTML = "");
    var n = document.getElementById("sel" + e),
        i = "";
    null == n ? (i = '<img src="/local/templates/main/img/close.png" style="cursor:hand;cursor:pointer" onclick="javascript:removeSel(' + e + ')"/>', s = '<div id = "sel' + e + '" class="station">', s += '<input id = "stS_' + e + '" type="hidden" name="m[]" value="' + Sts[e].id + '">', s += "<label for = stS_" + e + " >&nbsp;" + Sts[e].name + i + "</label>", s += "</div>", t.innerHTML += s) : n.style.display = "";
    var l = document.getElementById("st_" + Sts[e].id);
    l && (l.checked = !0), Sts[e].checked = !0;
    var c = document.getElementById("imm" + e);
    null != c && (c.src = "/local/templates/main/img/obana5.gif"), count++
}

function addToSelAll(e) {
    for (var t = 0; t < Sts.length; t++)
        if (!Sts[t].checked && Sts[t].line == e) {
            var n = document.getElementById("st_" + Sts[t].id);
            n.checked || (n.checked = !0, addToSel(t))
        }
}

function removeSelAll(e) {
    for (var t = 0; t < Sts.length; t++)
        if (Sts[t].checked && Sts[t].line == e) {
            var n = document.getElementById("st_" + Sts[t].id);
            n.checked && (n.checked = !1, removeSel(t))
        }
}

function removeSel(e) {
    $("#my_select :selected").remove();
    var t = document.getElementById("sel" + e);
    document.getElementById("selectedStations").removeChild(t);
    var n = document.getElementById("st_" + Sts[e].id);
    n && (n.checked = !1), 0 == --count && (document.getElementById("selectedStations").innerHTML = emptyText), Sts[e].checked = !1, document.getElementById("imm" + e).src = "/local/templates/main/img/obana4.gif", updateSel()
}

function removeAll() {
    for (i = 0; i < Sts.length; i++)
        if (Sts[i].checked) {
            var e = document.getElementById("st_" + Sts[i].id);
            e && (e.checked = !1), Sts[i].checked = !1, document.getElementById("imm" + i).src = "/local/templates/main/img/obana4.gif"
        } count = 0, document.getElementById("selectedStations").innerHTML = emptyText
}
var emptyText = "",
    divStyle = 'style="vertical-align:middle;font-size:11px; padding:0; margin:0;"',
    inputStyle = 'style="padding:0; margin:0;width:9px; height:9px;vertical-align:middle"',
    labelStyle = 'style="font-size:11px;"',
    k = 0,
    i = 0,
    count = 0,
    lines = [],
    stByLine = [],
    centerStation = [3, 7, 8, 18, 19, 52, 60, 62, 64, 70, 75, 88, 98, 110, 113, 120, 131, 132, 137, 140, 143, 144, 151, 152, 154, 170, 173, 174],
    centerStationExt = [0, 1, 2, 4, 9, 12, 13, 14, 15, 27, 31, 34, 36, 39, 40, 41, 43, 44, 50, 51, 54, 55, 58, 59, 61, 66, 67, 68, 69, 72, 73, 77, 78, 82, 83, 90, 93, 99, 100, 101, 109, 111, 112, 115, 116, 118, 122, 123, 125, 128, 129, 130, 133, 134, 136, 139, 142, 145, 150, 153, 159, 167, 168, 175, 176, 177, 180],
    IE = null != document.all;
loadStByLine();